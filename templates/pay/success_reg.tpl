<!-- <%$smarty.template%> -->
<%include file="header.tpl" page_title="The Sign Registry" currPage=$smarty.template%>

<div id="reg">

<h2 class="lr">PAYMENT COMPLETE</h2>

<h3>We have received your payment</h3>

<p>Thank you for visiting The Sign Registry and registering <%$numSigns%> new sign<%if $numSigns ne '1'%>s<%/if%> you plan on sending to those left behind after your departure from this physical world.</p>  
 
<p>A confirmation email has been sent to you.  Please remember not to discuss the registered sign with the designated recipient.</p>

</div>
 
<%include file="footer.tpl"%>
