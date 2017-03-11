<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="Author" content="Cashmopolit" />
<meta name="Publisher" content="Cashmopolit" />
<meta name="Copyright" content="Cashmopolit" />
<meta name="Content-language" content="en" />
<title>Star Rating...</title>
<meta name="Keywords" content="Tutorial how to jQuery Star Rating plugin" />
<meta name="Description" content="Tutorial how to jQuery Star Rating plugin" />


<!--==Star Rating=========================================================================-->
<link rel="stylesheet" href="ui.tabs.css" type="text/css" />
<link type="text/css" rel="stylesheet" href="../../css/star_rating.css" />
<link rel="stylesheet" href="jquery.rating.css" type="text/css" />

<script type="text/javascript" src="jquery.js" ></script>
<script type="text/javascript" src="ui.core.min.js"></script>
<script type="text/javascript" src="ui.tabs.min.js"></script>
<script type="text/javascript" src="jquery.rating.js"></script>
<script type="text/javascript" src="jquery.MetaData.js"></script>
<!--==end Star Rating=========================================================================-->

<script type="text/javascript">
/*
	$(function(){
		$('#tabs').tabs();
		$('#sub-tabs1').tabs();
	});
*/
</script>
</head>
<body>      
        <div id="tabs-3">
       	<script type="text/javascript" language="javascript">
		/*
			$(function(){ 
				$('#form1 :radio.star').rating(); 
				$('#form2 :radio.star').rating({cancel: 'Cancel', cancelValue: '0'}); 
				$('#form3 :radio.star').rating(); 
				$('#form4 :radio.star').rating(); 
			});
		*/
      	</script>
        <script>
		
			$(function(){
				$('#tabs-3 form').submit(function(){
					$('.test',this).html('');
						$('input',this).each(function(){
							if(this.checked) $('.test',this.form).append(''+this.name+': '+this.value+'<br/>');
						});
					return false;
				});
			});
		
        </script>
          
        <!--/*/<h2>Example 3-B With hover effects RITH PHEARUN</h2>-->
          
		<script>
			$(function(){
 				$('.hover-star').rating({
  					focus: function(value, link){
    // 'this' is the hidden form element holding the current value
    // 'value' is the value selected
    // 'element' points to the link element that received the click.
    				var tip = $('#hover-test');
    				tip[0].data = tip[0].data || tip.html();
    				tip.html(link.title || 'value: '+value);
  				},
  				blur: function(value, link){
    			var tip = $('#hover-test');
    			$('#hover-test').html(tip[0].data || '');
  				}
				});
			});
		</script>
        
          <form id="form3B">
            
            <!--<p>Rating 1: (1 - 3, default 2) </p>-->
            <p>
              <input class="hover-star" type="radio" name="test-3B-rating-1" value="1" title="Very poor"/>
              <input class="hover-star" type="radio" name="test-3B-rating-1" value="2" title="Poor"/>
              <input class="hover-star" type="radio" name="test-3B-rating-1" value="3" title="OK"/>
              <input class="hover-star" type="radio" name="test-3B-rating-1" value="4" title="Good"/>
              <input class="hover-star" type="radio" name="test-3B-rating-1" value="5" title="Very Good"/>
              <span id="hover-test" style="margin:0 0 0 20px;">Hover tips will appear in here</span> 
              <!--<div class="test"> -->
              	<span class="test" style="color:#FF0000">Results will be displayed here</span>
              <!--</div>-->
           	</p>
              
            <p>

            <p>
              <input type="submit" value="Submit scores!"/>
            </p>
          </form>

  </div>

</body>
</html>