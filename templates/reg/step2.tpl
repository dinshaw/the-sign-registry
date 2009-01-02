<!-- <%$smarty.template%> -->
<%include file="header.tpl" page_title="The Sign Registry" currPage=$smarty.template%>

<div id="reg">
<h2 class="lr">REGISTER A SIGN <span>Step 2</span></h2>
<p>Enter a complete description of the sign in the box below</p>

<%if $msg %><p class="red"><%$msg|nl2br%></p><%/if%>

<blockquote>
Prior research shows there are many ways a deceased person might communicate or leave a sign for their loved ones still in this physical world.  Here are some examples to help you understand and create your personal sign.</blockquote>
<dl>
	<dt>Appearance in a Dream <span class="small">(Dream Visits)</span>:</dt>
		<dd>&#8220;I will visit my sister during a dream wearing my red hat.&#8221;</dd>
	<dt>Sending A Message Telepathically <span class="small">(Telepathic Communication)</span>:</dt>
		<dd>&#8220;I will convey the thought, &#8216;smarty pants&#8217; into my brother's mind.&#8221;</dd>
	<dt>Energy Related Phenomenon:</dt>
		<dd>&#8220;I will make the kitchen lights flicker while my mother is washing the dishes&#8221;</dd>
	<dt>Moving an Object:</dt>
		<dd>&#8220;I will make a red book fall from the bookshelf.&#8221;</dd>
	<dt>Making An Appearance <span class="small">(Apparition)</span>:</dt>
		<dd>&#8220;I will make myself visible at the foot of the bed in the early morning hours.&#8221;</dd>
	<dt>Sending A Message Through a Third Party:</dt>
		<dd>&#8220;Someone will say the words, &#8216;pink panther&#8217; to my daughter.&#8221;</dd>
	<dt>Scent or Fragrance:</dt>
		<dd>&#8220;I will create the smell of cigar in the living room.&#8221;</dd>
	<dt>Touch:</dt>
		<dd>&#8220;I will play with your hair while you are at the ballgame.&#8221;</dd>
</dl>



<div class="lr">Registrant name: <strong><%$reg_name%></strong><span>Recipient Name: <strong><%$rec_name%></strong></span></div>

<form action="user.php?sid=<%$sid%>" method="post">
<input type="hidden" name="mode" value="reg" />
<input type="hidden" name="action" value="reg" />

<%if $userID %><input type="hidden" name="userID" value="<%$userID%>" /><%/if%>
<%if $recID %><input type="hidden" name="recID" value="<%$recID%>" /><%/if%>
<%if $signID %><input type="hidden" name="signID" value="<%$signID%>" /><%/if%>

<textarea name="description"><%$description%></textarea>

<p class="small">Would you like to add additional prepaid validation attempts?</p>
<p class="small">There are <%$defaultValidations%> prepaid validation attempts included with the registration of each sign. The cost of additional attempts are $5.00 each<span class="red">**</span></p>
<p class="small">If yes, after entering your sign details please click on the 'Add Validations' link in the left hand menu. 
<input type="hidden" name="prepaids" value="0" class="num" /></p>

<p>By proceding with this submission, I certify that the signs that I have listed in The Sign Registry will not be discussed with the designated recipient while I am alive.</p>

<div class="lr"><span><%if $edit eq "true"%><input type="submit" name="save2" value="Save Changes" class="button" /><%else%><input type="submit" name="step2" value="Continue" class="button" /></span><%/if%></div>

</form>
<p class="small footNote"><span class="red">**</span> Price subject to Change</p>
</div>
 
<%include file="footer.tpl"%>
