<?php

namespace App\MyHelpers\ProgressBar;

use App\MyHelpers\ProgressBar\ProgressBar as Progress;

class Stage
{
    private $status = array();

    private $default = array(
        'name'          => null,
        'message'       => null,
        'stageNum'      => 0,
        'totalItems'    => 1,
        'completeItems' => 0,
        'pcComplete'    => 0.0,
        'rate'          => null,
        'startTime'     => null,
        'curTime'       => null,
        'timeRemaining' => null,
        'exceptions'    => array(),
        'warnings'      => array(),
    );

    private $pu = null;

    /**
     * Magic set method - sets the $status[$var] to $val if it exists,
     * or throws an error otherwise.
     * @param string $var The var to set
     * @param mixed  $val What to set $status[$var] to
     */
    function __set($var, $val)
    {
        if (array_key_exists($var, $this->status)){
            $this->status[$var] = $val;
        } else {
            trigger_error(
                "Property $var doesn't exist and cannot be set.",
                E_USER_ERROR
            );
        }
        return $this;
    }

    /**
     * Magic get method, returns $this->$status[$var]
     * @param  string $var The var to get
     * @return mixed  $this->$status[$var]
     */
    function &__get($var)
    {
        if (array_key_exists($var, $this->status)){
            return $this->status[$var];
        } else {
            trigger_error(
                "Property $var doesn't exist and cannot be set.",
                E_USER_ERROR
            );
        }
    }

    /**
     * Constructor method
     * @param \Manticorp\ProgressUpdater $pu     The parent ProgressUpdater
     * @param array                      $status The initial status to set, if at all
     */
    function __construct(Progress $pu, $status = null)
    {
        $this->pu = $pu;
        $this->status = $this->default;
        $this->reset(false);
        if ($status !== null){
            $this->status = array_merge($this->default, $status);
        }
        $this->startTime = $this->curTime = microtime(true);
        return $this;
    }

    /**
     * Updates the $status array
     * @param  array             $status the status array
     * @return \Manticorp\Status $this
     */
    public function update($status = array())
    {
        $this->status = array_merge($this->status, $status);
        return $this;
    }

    /**
     * Simply returns the $status array
     * @return array
     */
    public function toArray()
    {
        return $this->status;
    }

    /**
     * Increments the stage item count by $n and optionally publishes the current status
     * @param  integer           $n             The amount to increment by
     * @param  boolean           $publishStatus Wether or not to publish the status
     * @return \Manticorp\Status $this
     */
    public function increment($n = 1, $publishStatus = false)
    {
        $this->completeItems = min(
            $this->completeItems + $n,
            $this->totalItems
        );

        $this->curTime = microtime(true);

        if ($this->pu->getAutocalc()) {
            if ($this->totalItems > 0 && $this->totalItems !== null)
                $this->pcComplete = min(1,((float)$this->completeItems/(float)$this->totalItems));
            else
                $this->pcComplete = 0;

            $this->rate = $this->completeItems / ($this->curTime - $this->startTime);

            if ($this->getStatusRate() > 0)
                $this->timeRemaining = (($this->totalItems - $this->completeItems) / $this->rate);
            else
                $this->timeRemaining = -1;
        }
        if ($publishStatus) {
            $this->pu->publishStatus();
        }
        return $this;
    }

    /**
     * Adds an exception
     *
     * @param string $msg  The exception message
     * @param int    $code The code
     * @return \Manticorp\Status $this
     */
    public function addException($msg, $code)
    {
        $this->status['exceptions'][] = array('msg'=>$msg, 'code'=>$code);
        return $this;
    }

    /**
     * Adds a warning
     *
     * @param string $msg  The warning message
     * @param int    $code The code
     * @return \Manticorp\Status $this
     */
    public function addWarning($msg, $code)
    {
        $this->status['warnings'][] = array('msg'=>$msg, 'code'=>$code);
        return $this;
    }

    /**
     * Removes all exceptions
     *
     * @return \Manticorp\Status $this
     */
    public function removeExceptions()
    {
        $this->status['exceptions'] = array();
        return $this;
    }

    /**
     * Removes all warnings
     *
     * @return \Manticorp\Status $this
     */
    public function removeWarnings()
    {
        $this->status['warnings'] = array();
        return $this;
    }

    /**
     * Removes all exceptions by $code
     *
     * @param  int $code The exception codes to remove
     * @return \Manticorp\Status $this
     */
    public function removeExceptionsByCode($code)
    {
        foreach($this->status['exceptions'] as &$warning) if($warning['code'] == $code) unset($warning);
        return $this;
    }

    /**
     * Removes all warnings by $code
     *
     * @param  int $code The warning codes to remove
     * @return \Manticorp\Status $this
     */
    public function removeWarningsByCode($code)
    {
        foreach($this->status['warnings'] as &$warning) if($warning['code'] == $code) unset($warning);
        return $this;
    }

    /**
     * Resets the stage to default values
     * @return object this
     */
    public function reset()
    {
        $sn = $this->stageNum;
        $this->status = $this->default;
        $this->stageNum = $sn;
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
            }
        } elseif (substr($method, 0, 3) == 'get') {
            if (substr($method, 3, 6) == 'Status') {
                $key = strtolower(substr($method, 9,1)) . substr($method, 10);
                return $this->status[$key];
            }
        } else {
            $msg = "Method: $method does not exists in ".get_class();
            throw new \BadMethodCallException($msg);
        }
    }
}