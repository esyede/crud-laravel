<footer class="main-footer">
	<div class="pull-right hidden-xs">
		<b>Versi</b> {{ config('app.version') }}
	</div>
	<strong>Hak Cipta &copy; {{ date('Y') }}
	<a href="{{ route('home') }}">Tim {{ config('app.name', 'Pengembang') }}</a>.</strong> Hak cipta dilindungi.
</footer>