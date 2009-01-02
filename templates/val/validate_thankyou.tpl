<!-- <%$smarty.template%> -->
<%include file="header.tpl" page_title="The Sign Registry" currPage=$smarty.template%>

<div id="reg">

<h2 class="lr">VALIDATION COMPLETE</h2>
<h3>We have received your input</h3>

<%if $msg %><p class="red"><%$msg|nl2br%></p>
<%else%>
<p>Thank you for visiting <strong>The Sign Registry Validation Room</strong> and entering your After Death Communication.</p>

<p>A confirmation email has been sent to you. Please allow a week to ten days for a search and response to your validation attempt.
</p>
<%/if%>
</div>
 
<%include file="footer.tpl"%>
