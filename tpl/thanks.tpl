<!-- BEGIN: MAIN -->
<h2>{PHP.L.thanks_for_user}: <a href="{THANKS_USER_URL}">{THANKS_USER_NAME}</a></h2>
<table class="cells">
	<tr>
		<td class="coltop">{PHP.L.Date}</td>
		<td class="coltop">{PHP.L.Sender}</td>
		<td class="coltop">{PHP.L.Category}</td>
		<td class="coltop">{PHP.L.Item}</td>
	</tr>
	<!-- BEGIN: THANKS_ROW -->
	<tr>
		<td>{THANKS_ROW_DATE}</td>
		<td><a href="{THANKS_ROW_FROM_URL}">{THANKS_ROW_FROM_NAME}</a></td>
		<td><a href="{THANKS_ROW_CAT_URL}">{THANKS_ROW_CAT_TITLE}</a></td>
		<td><a href="{THANKS_ROW_URL}">{THANKS_ROW_TITLE}</a></td>
	</tr>
	<!-- END: THANKS_ROW -->
</table>

<p class="pagination">{PAGEPREV} {PAGENAV} {PAGENEXT}</p>
<!-- END: MAIN -->