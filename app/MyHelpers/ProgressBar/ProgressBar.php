<?php

namespace App\MyHelpers\ProgressBar;

use Illuminate\Support\Facades\Storage;
use App\MyHelpers\ProgressBar\Stage;


class ProgressBar
{
    /**
     * Options for implemenation
     *
     *     string   lineBreak   What to use as the linebreak char, if need be
     *     string   filename    The output progress json file
     *     int      totalStages How many stages there will be
     *     boolean  autocalc    Whether to autocalculate certain values such as the
     *                          percentComplete, rate, etc. Setting this to false will
     *                          mean that you will provide these figures. Recommended to
     *                          keep this set to true
     *    boolean  handleErrors Whether to set a global error handler
     * @var array of options
     */
    private $options = array(
        'lineBreak'    => "\n",
        'filename'     => null,
        'totalStages'  => 1,
        'autocalc'     => true,
        'handleErrors' => true,
    );

    /**
     * This is where our stage will sit
     */
    public $stage = null;

    /**
     * Keeps track of the old error handler
     */
    private $oldErrorHandler = null;

    /**
     * Status that is written to the outfile, + stage params
     * @var array of status variables
     */
    private $status = array(
        'message'     => null,
        'totalStages' => null,
        'remaining'   => 1,
        'error'       => false,
        'complete'    => false,
    );

    /**
     * Default error status
     * @var array of error status variables
     */
    private $errorStatus = array(
        'message' => "An error has occurred",
        "error"   => true,
        'info'    => "No further information available"
    );

    /**
     * Constructs the object using the options provided, if not null. If no filename is
     * given, a filename will be generated, defaulting to the __DIR__.DIRECTORY_SEPARATOR.'Manticorp-ProgressUpdater.json'
     * @param array $options An array of options for instantiating this object
     */
    public function __construct($options = null)
    {
        if (is_array($options)) {
            $this->options = array_merge($this->options, $options);
        }
        if (is_null($this->options['filename'])) {
            $this->options['filename'] = 'progess.json';
        }
        $this->status['totalStages'] = $this->status['remaining'] = $this->options['totalStages'];
        $this->stage = new Stage($this);
        $this->setErrorHandler();
        return $this;
    }

    /**
     * Writes $this->status to the outfile in JSON format
     * @param  array  $status (optional) The status to write.
     * @return object         this
     */
    public function publishStatus($status = null)
    {
        if (is_null($status)) {
            $status = $this->getStatusArray();
        }
        try {
            Storage::put('progress.json', json_encode($status), 'public');
        } catch(\Exception $e){
            // We have to do this seperately, because we cannot write to the file!
            $status = array_merge($this->errorStatus, array(
                'message' => "Error writing to progress file :".$this->options['filename'],
                "error"   => true,
                'info'    => $e->getMessage()
            ));
            echo json_encode($status);
            exit();
        }
        return $this;
    }

    /**
     * Gets the status & stage as an array.
     * @return array The status + stage as an array
     */
    public function getStatusArray()
    {
        $status = $this->status;
        $status['stage'] = $this->stage->toArray();
        return $status;
    }

    /**
     * Publishes an error status, exiting the program
     * @param  array  $status The error status
     * @return null           Doesn't return, exits php
     */
    public function doError($status, $exit = true)
    {
        if (is_string($status)) {
            $m = $status;
            $status = $this->errorStatus;
            $status['message'] = $m;
        }
        $this->publishStatus($status);
        if ($exit) {
            echo json_encode($status);
            exit();
        }
    }

    public function setErrorHandler()
    {
        if($this->options['handleErrors']){
            $this->oldErrorHandler = set_error_handler(array(&$this, 'errorHandler'));
        }
        return $this;
    }

    public function removeErrorHandler()
    {
        if($this->options['handleErrors']){
            set_error_handler($this->oldErrorHandler);
        }
        return $this;
    }

    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        if (!(error_reporting() & $errno)) {
            // This error code is not included in error_reporting
            return;
        }
        $errorStr  = '<strong>ERROR</strong><br/><pre>'.PHP_EOL;
        $errorStr .= 'Code     : %-16s'.PHP_EOL;
        $errorStr .= 'File     : %s'.PHP_EOL;
        $errorStr .= 'Line     : %s'.PHP_EOL;
        $errorStr .= 'Message  : %s'.PHP_EOL;
        $errorStr .= '</pre>'.PHP_EOL;
        $errorStr = sprintf($errorStr, $errno, $errfile, $errline, $errstr);
        switch ($errno) {
            case E_USER_ERROR:
                $this->stage->addException($errorStr, $errno);
                $this->doError($errorStr);
                exit(1);
                break;

            case E_USER_WARNING:
                $this->stage->addWarning($errorStr, $errno);
                $this->doError($errorStr);
                exit(1);
                break;

            case E_USER_NOTICE:
                $this->stage->addWarning($errorStr, $errno);
                $this->doError($errorStr);
                exit(1);
                break;

            default:
                $this->stage->addWarning($errorStr, $errno);
                $this->doError($errorStr);
                exit(1);
                break;
        }

        /* Don't execute PHP internal error handler */
        return true;
    }

    /**
     * Sets an option for the $this->options array, checking if that option exists
     * @param string $name Name of the option
     * @param mixed  $val  What to set $this->options[$name] to
     */
    public function setOpt($name, $val = null)
    {
        if (!isset($this->options[$name])) {
            throw new \UnexpectedValueException('Class '.get_class().' has no option '.$name);
        }
        $this->options[$name] = $val;
        if (isset($this->status[$name])) {
            $this->status[$name] = $val;
        }
        return $this;
    }

    /**
     * Alias for setOpt
     * @see setOpt
     */
    public function setOption($name, $val = null)
    {
        return $this->setOpt($name, $val);
    }

    /**
     * Sets the options array to the argument
     * @param array $options The options array
     */
    public function setOpts($options = null)
    {
        if (!is_null($options) && !(count($options) === 0)) {
            $this->options = array_merge($this->options, $options);
        }
        return $this;
    }

    /**
     * Alias for setOpts
     * @see setOpts
     */
    public function setOptions($options = null)
    {
        return $this->setOpts($options);
    }

    /**
     * Returns the options array
     * @return array The options
     */
    public function getOpts()
    {
        return $this->getOptions();
    }

    /**
     * Returns the options array
     * @return array The options
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Gets an option by name
     * @param  string $name Name of the required option
     * @return mixed        The value of that option
     */
    public function getOption($name)
    {
        if (!isset($this->options[$name])) {
            throw new \UnexpectedValueException(get_class()." has no option ".$name);
        }
        return $this->options[$name];
    }

    /**
     * Gets the status array
     * @return array The status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Gets just the stage part of the status array
     * @return array The stage
     */
    public function getStage()
    {
        return $this->stage;
    }

    /**
     * Sets the progress to totally complete.
     *
     * This sets the status to totally complete, that is,
     * it writes a final status message without a stage and
     * sets the complete flag to true and error to false,
     * publising the progress file and outputting the final
     * status to the browser.
     * @param  string $msg (optional) The final message
     * @return object      this
     */
    public function totallyComplete($msg = null)
    {
        $msg = (is_null($msg)) ? 'Process Complete' : $msg;

        $status = array(
            'message'       => $msg,
            'error'         => false,
            'remaining'     => 0,
            'complete'      => true,
        );

        $this->status = array_merge($this->status, $status);
        $status = $this->getStatusArray();

        if (isset($status['stage'])) {
            unset($status['stage']);
        }

        echo json_encode($status);

        if (Storage::exists($this->options['filename'])) {
            Storage::delete($this->options['filename']);
        }

        return $this;
    }

    /**
     * Increments the stageNum and sets the next stage options
     * @param  array  $stage (optional) The stage options to use for the new stage
     * @return object        this
     */
    public function nextStage($stage = null)
    {
        $this->resetStage();

        if ($stage !== null){
            $this->stage->update($stage);
        }

        $this->status['remaining']--;
        $this->stage->stageNum  = $this->stage->stageNum+1;
        $this->stage->startTime = $this->stage->curTime = microtime(true);

        return $this->publishStatus();
    }

    /**
     * Resets the stage to default values
     * @return object this
     */
    public function resetStage()
    {
        $this->stage->reset(false);
        return $this;
    }

    /**
     * Updates the stage with the options given
     * @param  array  $stage Array of stage options
     * @return object        this
     */
    public function updateStage($stage)
    {
        $this->stage->update($stage);
        $this->stage->curTime = microtime(true);
        return $this->publishStatus();
    }

    /**
     * Increments the 'completeItems' counter for the current stage
     * @param  integer $n             Number to increment by, defaults to 1
     * @param  boolean $publishStatus Whether to publish the status file or not. Useful for
     *                                when the process iterates fast, so you might only want
     *                                to update the status every x iterations to stop the
     *                                progress file from constantly being accessed and changed
     * @return object                 this
     */
    public function incrementStageItems($n = 1, $publishStatus = false)
    {
        $this->stage->increment($n, $publishStatus);
        return $this;
    }

    /**
     * Magic call method, currently only used for magic setters and getters.
     * @param  string $method The method that was called
     * @param  array  $args   Array of arguments given
     * @return mixed          Either returns value for magic gets, or this for other stuff.
     */
    public function __call($method, $args)
    {
        if (substr($method, 0, 3) == 'set') {
            if (substr($method, 3, 6) == 'Status') {
                $key = strtolower(substr($method, 9,1)) . substr($method, 10);
                $this->status[$key] = $args[0];
                return $this;
            } elseif (substr($method, 3, 5) == 'Stage') {
                $key = strtolower(substr($method, 8,1)) . substr($method, 9);
                $this->stage->{$key} = $args[0];
                return $this;
            } elseif (
                array_key_exists(
                    strtolower(substr($method, 3,1)) . substr($method, 4),
                    $this->options
                )
            ){
                $this->options[strtolower(substr($method, 3,1)) . substr($method, 4)] = $args[0];
                return $this;
            } else {
                $var = strtolower(substr($method, 3,1)) . substr($method, 4);
                trigger_error(
                    "Property $var doesn't exist and cannot be set with a magic method.",
                    E_USER_ERROR
                );
            }
        } elseif (substr($method, 0, 3) == 'get') {
            if (substr($method, 3, 6) == 'Status') {
                $key = strtolower(substr($method, 9,1)) . substr($method, 10);
                return $this->status[$key];
            } elseif (substr($method, 3, 5) == 'Stage') {
                $key = strtolower(substr($method, 8,1)) . substr($method, 9);
                return $this->stage->{$key};
            } elseif (
                array_key_exists(
                    strtolower(substr($method, 3,1)) . substr($method, 4),
                    $this->options
                )
            ){
                return $this->options[strtolower(substr($method, 3,1)) . substr($method, 4)];
            } else {
                $var = strtolower(substr($method, 3,1)) . substr($method, 4);
                trigger_error(
                    "Property $var doesn't exist and cannot be gotten with a magic method.",
                    E_USER_ERROR
                );
            }
        } else {
            $msg = "Method: $method does not exists in ".get_class();
            throw new \BadMethodCallException($msg);
        }
    }
}