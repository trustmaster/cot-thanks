<!-- BEGIN: MAIN -->
<h2>{PHP.L.thanks_top}</h2>
<table class="cells">
	<tr>
		<td class="coltop">#</td>
		<td class="coltop">{PHP.L.User}</td>
		<td class="coltop">{PHP.L.Count}</td>
	</tr>
	<!-- BEGIN: THANKS_ROW -->
	<tr>
		<td>{THANKS_ROW_NUM}</td>
		<td>{THANKS_ROW_NAME}</td>
		<td><a href="{THANKS_ROW_URL}">{THANKS_ROW_TOTALCOUNT}</a></td>
	</tr>
	<!-- END: THANKS_ROW -->
</table>

<p class="pagination">{PAGEPREV} {PAGENAV} {PAGENEXT}</p>

<!-- END: MAIN -->