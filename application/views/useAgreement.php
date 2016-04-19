<!DOCTYPE html>
<html lang="en">
<head>
	<title>Use Agreement Form</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="shortcut icon" href="http://library.marist.edu/archives/icon/box.png" />
	<link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/library.css" />
	<link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/library_child.css" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="http://library.marist.edu/archives/mainpage/mainStyles/style.css" />
	<link rel="stylesheet" type="text/css" href="http://library.marist.edu/archives/mainpage/mainStyles/main.css" />
	<link rel="stylesheet" type="text/css" href="/useagreement/styles/useagreement.css" />
	<script type="text/javascript" src="http://library.marist.edu/archives/mainpage/scripts/archivesChildMenu.js"></script>
	<script type="text/javascript" src="/useagreement/js/cloneRequests.js"></script>
	<?php
	$userId= $_GET['userId'];
	//researcher info
	$sizeofRequests = sizeof($requests);
	$userName = $researcher[0];
	$citystate = $researcher[1];
	$address =$researcher[2];
	$emailId = $researcher[3];
	$zipCode = $researcher[4];
	$comments = $researcher[5];
	$date = $researcher[6];
	$phoneNumber = $researcher[7];
	$status = $researcher[8];
	$instructions = $researcher[9];
	$researcherUrl = base_url("index.php/usragr/getResearcher?userId=").$userId;
	?>
	<script type="text/javascript">
		$(document).ready(function(){
			<?php  if($status == 2) {?>
			document.getElementById("submit").disabled = true;
			document.getElementById("save").disabled = true;

			<?php } ?>
			$('#datepicker').datepicker();
			var requestsCnt = 0;
			var reqSize = "<?php echo sizeof($requests)?>";
			var fields = $('div#request_input').html();
			for (var j= 0;j<reqSize; j++ ) {
				var request_input = "";
				requestsCnt = requestsCnt + 1;
				request_input = "request_input" + requestsCnt + "";
				var requests = "<div id=" + request_input + " style='border-bottom: 1px solid; padding: 10px;'>" + fields;
				$('div#formcontents').append(requests);
			}
			requestsCnt = 0;
			<?php if($sizeofRequests>0){ ?>
			<?php foreach($requests as $request){ ?>
			var requestId= '<?php echo $request[0]?>';
			requestsCnt++;
			var str1 = "div#request_input";
			var str2 = str1.concat(requestsCnt);
			var requestIds =[];
			requestIds.push(str2.concat(" input#request_collection"));
			requestIds.push(str2.concat(" input#request_boxno"));
			requestIds.push(str2.concat(" input#request_itemno"));
			requestIds.push(str2.concat(" input:not(:checked)[name='dpi'][value='72']"));
			requestIds.push(str2.concat(" input:not(:checked)[name='dpi'][value='300']"));
			requestIds.push(str2.concat(" input:not(:checked)[name='dpi'][value='600']"));
			requestIds.push(str2.concat(" input:not(:checked)[name='dpi'][value='1200']"));
			requestIds.push(str2.concat(" input:not(:checked)[name='format'][value='pdf']"));
			requestIds.push(str2.concat(" input:not(:checked)[name='format'][value='jpeg']"));
			requestIds.push(str2.concat(" input:not(:checked)[name='format'][value='tiff']"));
			requestIds.push(str2.concat(" input:not(:checked)[name='avformat'][value='wav']"));
			requestIds.push(str2.concat(" input:not(:checked)[name='avformat'][value='mp3']"));
			requestIds.push(str2.concat(" input:not(:checked)[name='avformat'][value='mpeg']"));
			requestIds.push(str2.concat(" input:not(:checked)[name='avformat'][value='hd']"));
			$(requestIds[0]).val('<?php echo $request[1]?>');
			$(requestIds[1]).val('<?php echo $request[2]?>');
			$(requestIds[2]).val('<?php echo $request[3]?>');
			<?php foreach($request[4] as $dpi) {?>

			if("<?php echo $dpi ?>" == "72"){
				$(requestIds[3]).attr('checked',true);
			}else if("<?php echo $dpi ?>" == "300"){
				$(requestIds[4]).attr('checked',true);
			}else if("<?php echo $dpi ?>" == "600"){
				$(requestIds[5]).attr('checked',true);
			}else if("<?php echo $dpi ?>" == "1200"){
				$(requestIds[6]).attr('checked',true);
			}
			<?php }?>
			<?php foreach($request[5] as $format) {?>

			if("<?php echo $format ?>" == "pdf"){
				$(requestIds[7]).attr('checked',true);
			}else if("<?php echo $format ?>" == "jpeg"){
				$(requestIds[8]).attr('checked',true);
			}else if("<?php echo $format ?>" == "tiff"){
				$(requestIds[9]).attr('checked',true);
			}
			<?php }?>
			<?php foreach($request[6] as $avformat) {?>

			if("<?php echo $avformat ?>" == "wav"){
				$(requestIds[10]).attr('checked',true);
			}else if("<?php echo $avformat ?>" == "mp3"){
				$(requestIds[11]).attr('checked',true);
			}else if("<?php echo $avformat ?>" == "mpeg"){
				$(requestIds[12]).attr('checked',true);
			}else if("<?php echo $avformat ?>" == "hd"){
				$(requestIds[13]).attr('checked',true);
			}
			<?php }?>

			<?php } ?>
			<?php }?>
			//alert(requestsCnt);
			$('button#save').click(function(){
				var date = $('input#datepicker').val();
				var userName = $('input#name').val();
				var address = $('input#address').val();
				var citystate = $('input#citystate').val();
				var zipCode = $('input#zip').val();
				var emailId = $('input#email').val();
				var comments = $('textarea#comments').val();
				var phoneNumber = $('input#phoneNo').val();
				var requestCount= $("#formcontents > div").length-1
				var file = $('input#uploaded_file')[0].files[0];
				var files =[];
				files.push(file);
				var requestList= [];
				//iterating multiple requests.
				for(var i=1; i<=requestCount; i++) {
					var checked = [];
					var imageResolutions = "";
					var fileFormats = "";
					var avFormats = "";
					var str1 = "div#request_input";
					var str2 = str1.concat(i);
					var request = [];
					var reqCollection = $(str2.concat(" input#request_collection")).val();
					var boxNumber = $(str2.concat(" input#request_boxno")).val();
					var itemNumber = $(str2.concat(" input#request_itemno")).val();
					$.each($(str2.concat(" input:checked[name='dpi']")), function () {
						imageResolutions = imageResolutions.concat($(this).val());
						imageResolutions = imageResolutions.concat(":");
					});
					imageResolutions = imageResolutions.slice(0, -1);
					$.each($(str2.concat(" input:checked[name= 'format']")), function () {
						checked.push($(this).val());
						fileFormats = fileFormats.concat($(this).val());
						fileFormats = fileFormats.concat(":");
					});
					fileFormats = fileFormats.slice(0, -1);

					$.each($(str2.concat(" input:checked[name= 'avformat']")), function () {
						checked.push($(this).val());
						avFormats = avFormats.concat($(this).val());
						avFormats = avFormats.concat(":");
					});
					avFormats = avFormats.slice(0, -1);
					request.push(reqCollection);
					request.push(boxNumber);
					request.push(itemNumber);
					request.push(imageResolutions);
					request.push(fileFormats);
					request.push(avFormats);
					requestList.push(request);
				}
				$.post("<?php echo base_url("?c=usragr&m=saveResearcher&userId=".$userId);?>", {
					date:date,
					userName: userName,
					address : address,
					zipCode : zipCode,
					citystate: citystate,
					emailId: emailId,
					comments:comments,
					phoneNumber:phoneNumber,
					requestCount:requestCount,
					requestList:requestList
				}).done(function (userId) {
					if (userId > 0) {

						alert("Form saved successfully for UserId:"  + userId);

					}else
					{
						alert("Falied to save use agreement form"+userId);
					}
				});
			});
			$('button#submit').click(function(){
				<?php  if($status == 1) {?>
				var date = $('input#datepicker').val();
				var userName = $('input#name').val();
				var address = $('input#address').val();
				var citystate = $('input#citystate').val();
				var zipCode = $('input#zip').val();
				var emailId = $('input#email').val();
				var comments = $('textarea#comments').val();
				var phoneNumber = $('input#phoneNo').val();
				var requestCount = $("#formcontents > div").length - 1
				var file = $('input#uploaded_file')[0].files[0];
				var files = [];
				files.push(file);
				var requestList = [];
				//iterating multiple requests.
				for (var i = 1; i <= requestCount; i++) {
					var checked = [];
					var imageResolutions = "";
					var fileFormats = "";
					var avFormats = "";
					var str1 = "div#request_input";
					var str2 = str1.concat(i);
					var request = [];
					var reqCollection = $(str2.concat(" input#request_collection")).val();
					var boxNumber = $(str2.concat(" input#request_boxno")).val();
					var itemNumber = $(str2.concat(" input#request_itemno")).val();
					$.each($(str2.concat(" input:checked[name='dpi']")), function () {
						imageResolutions = imageResolutions.concat($(this).val());
						imageResolutions = imageResolutions.concat(":");
					});
					imageResolutions = imageResolutions.slice(0, -1);
					$.each($(str2.concat(" input:checked[name= 'format']")), function () {
						checked.push($(this).val());
						fileFormats = fileFormats.concat($(this).val());
						fileFormats = fileFormats.concat(":");
					});
					fileFormats = fileFormats.slice(0, -1);

					$.each($(str2.concat(" input:checked[name= 'avformat']")), function () {
						checked.push($(this).val());
						avFormats = avFormats.concat($(this).val());
						avFormats = avFormats.concat(":");
					});
					avFormats = avFormats.slice(0, -1);
					request.push(reqCollection);
					request.push(boxNumber);
					request.push(itemNumber);
					request.push(imageResolutions);
					request.push(fileFormats);
					request.push(avFormats);
					requestList.push(request);

				}
				$.post("<?php echo base_url("?c=usragr&m=submitResearcher&userId=".$userId);?>", {
					date: date,
					userName: userName,
					address: address,
					zipCode: zipCode,
					citystate: citystate,
					emailId: emailId,
					comments: comments,
					phoneNumber: phoneNumber,
					requestCount: requestCount,
					requestList: requestList
				}).done(function (userId) {
					if (userId > 0) {
						alert("Form Submitted successfully for UserId:" + userId);
					} else {
						alert("Falied to Submit use agreement form" + userId);
					}
				});
				var m_data = new FormData();
				m_data.append('user_name', $('input#name').val());
				m_data.append('user_email', $('input#email').val());
				m_data.append('phone_number', $('input#phoneNo').val());
				m_data.append('file_attach', $('input#uploaded_file')[0].files[0]);
				m_data.append('date', $('input#datepicker').val());
				$.ajax({
					type: "POST",
					url: "<?php echo base_url("?c=usragr&m=mailAttachment&userId=".$userId);?>",
					data: m_data,
					processData: false,
					contentType: false,
					cache: false,
					success: function (response) {
						//load json data from server and output message
						if (response.type == 'error') { //load json data from server and output message
							output = '<div class="error">' + response.text + '</div>';
						} else {
							output = '<div class="success">' + response.text + '</div>';
						}
						$("#contact_form #contact_results").hide().html(output).slideDown();
					}
				});
				document.getElementById("submit").disabled = true;
				document.getElementById("save").disabled = true;

				<?php }else{ ?>
				alert("you cannot edit the form..! as the form submitted already");
				<?php } ?>
			});//end of submit function
			$('div#request_input').clone();
		});
		//});// end of document function
	</script>
</head>
<body>
<div id="headerContainer">
	<div id="header">
		<div id="logo">
		</div><!-- /logo -->
	</div>
</div>
<div id="menu">
	<div id="menuItems">
	</div><!-- /menuItems -->
</div><!-- /menu -->
<div class= "content_container">
	<div class = "container_home_child" >
		<div class = "ref_box">
			<table>
				<th class = "search_drop_header" colspan="4">Library Resources</th>
				<tr>
					<td class = "search_drop"><a href="http://voyager.marist.edu/vwebv/searchBasic"><img src ="http://library.marist.edu/images/library_catalog_red.png" title="Library Catalog"></a></td>
					<td class = "search_drop"><a href="http://libguides.marist.edu/"><img src ="http://library.marist.edu/images/library_pathfinders_red.png" title="Pathfinders"></a></td>
					<td class = "search_drop"><a href="http://library.marist.edu/forms/ask.php"> <img src ="http://library.marist.edu/images/ask_a_librarian_red.png" title="Ask A Librarian"></a></td>
					<td class = "search_drop_last"><a href="http://site.ebrary.com.online.library.marist.edu/lib/marist/home.action"><img src ="http://library.marist.edu/images/ebrary_small.png" title ="ebrary"></a></td>
				</tr>
			</table>
		</div>
		<div class="content">
			<p class="breadcrumb">
				<a href="http://library.marist.edu" class="map_link"><img src="http://library.marist.edu/images/home.png" class="fox2"/></a>
				> Forms > Reserve Forms
			</p>
			<div id="researcherInfo"><h1 class="page_head" style="float: none;">Use Agreement Form</h1>
				<h2>Researcher's Information:</h2>
				<div class="formcontents">
					<label class="label">Date:</label><br/><input type="text" id="datepicker" class="textinput" value = "<?php echo $date; ?>" style="width: 100px;"/>
					<label class="label">Researcher's Name:</label><br/><input type="text" id="name" class="textinput" value = "<?php echo $userName; ?>"/>
					<label class="label">Address:</label><br/><input type="text" id="address" class="textinput" value = "<?php echo $address; ?>" />
					<label class="label">City/State:</label><br/><input type="text" id="citystate" class="textinput" value = "<?php echo $citystate; ?>" />
					<label class="label">Zip:</label><br/><input type="text" id="zip" class="textinput" value = "<?php echo $zipCode; ?>" />
					<label class="label">Phone Number:</label><br/><input type="text" id="phoneNo" class="textinput" value = "<?php echo $phoneNumber; ?>" />
					<!--p><label class="label">City/State:</label><input type="text" id="citystate" class="textinputinline" style="margin-right: 20px;"/><label class="label">Zip:</label><input type="text" id="zip" class="textinputinline" style="width:125px;"/></p-->
					<label class="label">Email:</label><br/><input type="text" id="email" class="textinput" value = "<?php echo $emailId; ?>" />
					<label class="label">Comments (optional):</label><br/><textarea id="comments" rows="4" cols="50" style="display: block; margin-bottom: 10px;" ><?php echo $comments; ?></textarea>
				</div>

				<h2>Conditions of use</h2>
				<div class="formcontents" style="height: 100px; border:1px solid black; overflow-y: auto; padding: 10px;">
					<ul>
						<li>(1) To use the image(s), audio, or video only for the purpose or project stated above. Later and different use constitutes reuse and is
							prohibited. Subsequent requests for permission to reuse image(s), audio, or video must be made in writing. A reuse fee may apply</li><br/>
						<li>(2) To give proper credit for the image(s), audio, or video. Unless otherwise stated on the photographic copy, the credit line should
							read: James A. Cannavino Library, Archives & Special Collections, Marist College, USA. When the name of the photographer
							or collection is supplied, this should also be included in the credit. The placement of credit should be as follows:</li>
					</ul>
				</div>
				<p><label style="font-weight: bold;">Copyright Notice: </label>The individual requesting reproductions expressly assumes the responsibility for compliance with all pertinent provisions of
					the Copyright Act, 17 U.S.C. ss101 et seq. The patron further agrees to indemnify and hold harmless the Marist College Archives & Special
					Collections and its staff in connection with any disputes arising from the Copyright Act, over the reproduction of material at the request of the
					patron.</p>
				<input type="checkbox" value="Accept" class="checkbox">I accept and agree with the conditions of use.</input><br/>
				<label>Applicant's Initials</label><input type="text" id="name" class="textinput"/>


				<h2>Requests:</h2>
				<div class="formcontents" id="formcontents">
					<label>Add/Remove Requests</label><br/>
					<button id="buttonAdd-request" >+</button>
					<button id="buttonRemove-request" disabled style="opacity: 0.5;">-</button></br>
					<div id="request_input" style="border-bottom: 1px solid; padding: 10px; display: none;">
						<label class="label" for="collection">Collection:</label><br/><input type="text" id="request_collection" class="textinput" <!--value="--><--?php /*echo $collection */?> "/>
						<label class="label" for="boxno">Box Number:</label><br/><input type="text" id="request_boxno" class="textinput" <!--value="--><--?php /*echo $boxNumber */?> "/>
						<label class="label" for="itemno">Item Numbers:</label><br/><input type="text" id="request_itemno" class="textinput" <!--value="--><--?php /*echo $itemNumber */?> "/>
						<label class="label" for="dpi">Requested Resolution (dpi):</label><br/>
						<input type="checkbox" name="dpi" value="72" class="checkbox">72</input>
						<input type="checkbox" name="dpi" value="300" class="checkbox">300</input>
						<input type="checkbox" name="dpi" value="600" class="checkbox">600</input>
						<input type="checkbox" name="dpi" value="1200" class="checkbox">1200</input><br/><br/>
						<label class="label" for="format">Requested File Format:</label><br/>
						<input type="checkbox" name="format" value="pdf" class="checkbox">PDF</input>
						<input type="checkbox" name="format" value="jpeg" class="checkbox">JPEG</input>
						<input type="checkbox" name="format" value="tiff" class="checkbox">TIFF</input><br/><br/>
						<label class="label" for="avformat">Audio/Video File Format:</label><br/>
						<input type="checkbox" name="avformat" value="wav" class="checkbox">WAV</input>
						<input type="checkbox" name="avformat" value="mp3" class="checkbox">MP3</input>
						<input type="checkbox" name="avformat" value="mpeg" class="checkbox">MPEG</input>
						<input type="checkbox" name="avformat" value="hd" class="checkbox">HD</input><br/><br/>
						<label class="label" for="desc">Description of Use (Provided by the researcher):</label><br/><textarea id="request_desc" rows="4" cols="4"/></textarea>
					</div><!-- request_input template -->
				</div> <!-- formcontents -->
				<div id="instructions" >
					<label class="label">Instructions (For Office Use Only):</label><br/><textarea id="instructions" rows="4" cols="50" style="display: block; margin-bottom: 10px;" ><?php echo $instructions; ?></textarea>

				</div >

				<input class='btn' type="file" name="uploaded_file" id="uploaded_file">
				<button class="btn" type="submit" id="submit">Submit</button>
				<button class="btn" type="button" id="save">Save</button></br>

			</div> <!-- researcherInfo -->

		</div> <!-- content -->
	</div>

	<div class="bottom_container">
				<p class = "foot">
					James A. Cannavino Library, 3399 North Road, Poughkeepsie, NY 12601; 845.575.3199
					<br />
					&#169; Copyright 2007-2016 Marist College. All Rights Reserved.

					<a href="http://www.marist.edu/disclaimers.html" target="_blank" >Disclaimers</a> | <a href="http://www.marist.edu/privacy.html" target="_blank" >Privacy Policy</a> | <a href="http://library.marist.edu/ack.html?iframe=true&width=50%&height=62%" rel="prettyphoto[iframes]">Acknowledgements</a>
				</p>
		</div>
		<script>
			
		</script>
	</body>
</html>
