<?php require_once('http://downardo.com/template/head.php'); ?>

<style>
h1{
  margin: 10px 0;
  font-family: inherit;
  font-weight: bold;
  line-height: 1;
  color: inherit;
  text-rendering: optimizelegibility;
  font-size: 36px;
  line-height: 40px;
}
p { padding-top:20px}
</style>

<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
function strengthMeter(passwordFieldId, nodes) {

    // init undefined 
    if ('undefined' === typeof(nodes)) {
        var nodes = 1;
    }   
    
    // init character classes
    var password = $("#" + passwordFieldId).attr('value');
    var numEx = /\d/;
    var lcEx = /[a-z]/;
    var ucEx = /[A-Z]/;
    var syEx = /\W/;
    var meterMult = 1;
    var character_set_size = 0;
    
    // loop over each char of the password and check it per regexes above.
    // weight numbers, upper case and lowercase at .75, 1 and .25 respectively.
    if (numEx.test(password)) {
        character_set_size += 10;
    }
    if (ucEx.test(password)) {
        character_set_size += 26;
    }
    if (lcEx.test(password)) {
        character_set_size += 26;
    }
    if (syEx.test(password)) {
        character_set_size += 32;
    }

    // assume that 100% is a meterMult of maxMulti
    var strength = Math.pow(character_set_size, password.length);

    // init crackers at hashes/second
    // all numbers from slowest computer here http://hashcat.net/oclhashcat-plus/
    var rateMd5 = 1333000000; 
    var rateSHA1 = 433000000;
    var rateMd5crypt = 855000;
    var rateBcrypt = 604;
        
    // calculate a human readable time based on seconds and nodes
    var secMd5 = secondsToStr(toFixed(strength/(rateMd5*nodes))); 
    var secSHA1 = secondsToStr(toFixed(strength/(rateSHA1*nodes)));
    var secMd5crypt = secondsToStr(toFixed(strength/(rateMd5crypt*nodes)));
    var secBcrypt = secondsToStr(toFixed(strength/(rateBcrypt*nodes)));
    
    var rates = "MD5: " + secMd5 + " <br/>" +
        "SHA1: " + secSHA1 +  "<br/>" +
        "MD5Crypt: " + secMd5crypt + "<br/>" +
        "Bcrypt: " + secBcrypt + "<br/>" +
       " ";
    
    // if null, don't show anything
    if (password.length > 0) {
        $("#passwordIndicator").show();
        $("#possibilities").html(numberWithCommas(strength) + " Possibilities");
        $("#nodes").val(nodes);
        $("#rates").html(rates);
    } else {
        $("#passwordIndicator").hide();
    }
    
}

$(document).ready(function() {
    $("#fmPass").keyup(function(event) {
        strengthMeter("fmPass",$("#nodes").val());
    });
    $("#nodes").keyup(function(event) {
        strengthMeter("fmPass", $("#nodes").val());
    });
    strengthMeter("fmPass",$("#nodes").val());
});






// thanks http://stackoverflow.com/questions/2901102/how-to-print-number-with-commas-as-thousands-separators-in-javascript
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

// thanks http://stackoverflow.com/questions/8211744/convert-milliseconds-or-seconds-into-human-readable-form
function secondsToStr(seconds){
    // TIP: to find current time in milliseconds, use:
    // var milliseconds_now = new Date().getTime();
    seconds = Math.round(seconds);
    var numyears = Math.floor(seconds / 31536000);
    if(numyears){
        return numberWithCommas(numyears) + ' year' + ((numyears > 1) ? 's' : '');
    }
    var numdays = Math.floor((seconds % 31536000) / 86400);
    if(numdays){
        return numdays + ' day' + ((numdays > 1) ? 's' : '');
    }
    var numhours = Math.floor(((seconds % 31536000) % 86400) / 3600);
    if(numhours){
        return numhours + ' hour' + ((numhours > 1) ? 's' : '');
    }
    var numminutes = Math.floor((((seconds % 31536000) % 86400) % 3600) / 60);
    if(numminutes){
        return numminutes + ' minute' + ((numminutes > 1) ? 's' : '');
    }
    var numseconds = (((seconds % 31536000) % 86400) % 3600) % 60;
    if(numseconds){
        return numseconds + ' second' + ((numseconds > 1) ? 's' : '');
    }
    return 'less then a second'; //'just now' //or other string you like;
}

// thanks http://stackoverflow.com/questions/1685680/how-to-avoid-scientific-notation-for-large-numbers-in-javascript
function toFixed(x) {
  if (Math.abs(x) < 1.0) {
    var e = parseInt(x.toString().split('e-')[1]);
    if (e) {
        x *= Math.pow(10,e-1);
        x = '0.' + (new Array(e)).join('0') + x.toString().substring(2);
    }
  } else {
    var e = parseInt(x.toString().split('+')[1]);
    if (e > 20) {
        e -= 20;
        x /= Math.pow(10,e);
        x += (new Array(e+1)).join('0');
    }
  }
    return x;
}

// thanks http://stackoverflow.com/questions/995183/how-to-allow-only-numeric-0-9-in-html-inputbox-using-jquery
    $("#nodes").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
    });

});//]]>  

</script>


</head>
<body>
  <H1>Geek's Password Strength Meter </h1>


    This is the strength meter that every site should show when you're creating an account with them. It tells you how many possible passwords there are based on the length and character classes used.


<p>
The password "1p" has 2 characters, one  a lowercase letter and one a number.  To brute force this password, there are 26 possible letters and 10 possible numbers which is (10 + 26) * (10 + 26) = 1,296 possibilities
    . Less than a second to crack!
</p>

<p >These numbers only for demonstration purposes.  Please do your own research on password security!  The numbers are derived from <a href="http://hashcat.net/oclhashcat-plus/">hashcat's site</a>.</p>

<p>
<label class=""  for="fmPass">
<span>Password</span>    
    
<input id="fmPass" type="password" value="" name="Pass" maxlength="100">
</label>
</p>
    <div id="passwordIndicator" >
        <p>
            <span  id="possibilities" class="reset"></span>
        </p>
        <p>
        Time to crack using <input type="text" id="nodes" value="1" size="5" /> core(s):
        </p>
        <p>
        <span  id="rates" class="reset"></span>
        </p>
    </div>






<?php require_once('http://downardo.com/template/footer.php'); ?>
