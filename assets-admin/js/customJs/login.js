var TxtType = function(el, toRotate, period) {
    this.toRotate = toRotate;
    this.el = el;
    this.loopNum = 0;
    this.period = parseInt(period, 10) || 2000;
    this.txt = '';
    this.tick();
    this.isDeleting = false;
};

TxtType.prototype.tick = function() {
    var i = this.loopNum % this.toRotate.length;
    var fullTxt = this.toRotate[i];

    if (this.isDeleting) {
    this.txt = fullTxt.substring(0, this.txt.length - 1);
    } else {
    this.txt = fullTxt.substring(0, this.txt.length + 1);
    }

    this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

    var that = this;
    var delta = 200 - Math.random() * 100;

    if (this.isDeleting) { delta /= 2; }

    if (!this.isDeleting && this.txt === fullTxt) {
    delta = this.period;
    this.isDeleting = true;
    } else if (this.isDeleting && this.txt === '') {
    this.isDeleting = false;
    this.loopNum++;
    delta = 500;
    }

    setTimeout(function() {
    that.tick();
    }, delta);
};

window.onload = function() {
    var elements = document.getElementsByClassName('typewrite');
    for (var i=0; i<elements.length; i++) {
        var toRotate = elements[i].getAttribute('data-type');
        var period = elements[i].getAttribute('data-period');
        if (toRotate) {
          new TxtType(elements[i], JSON.parse(toRotate), period);
        }
    }
    // INJECT CSS
    var css = document.createElement("style");
    css.type = "text/css";
    css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
    document.body.appendChild(css);
};
$(document).ready(function () {
	var baseurl =$("#baseurl").val();
	$(document).on("click","#loginBtn",function(e){
		e.preventDefault();
	
		if(loginRequired())
		{
			var formData = $("#admiLoginForm" ).serialize();
			formData = decodeURI(formData);
			 
			$("#verifying-account").css("display","block");
			$("#loginBtn").css("display","none");
			$.ajax({
				type: "POST",
				url: baseurl + 'login/check_login',
				dataType: "json",
				contentType: "application/x-www-form-urlencoded; charset=UTF-8",
				data: {formDatas:formData},
				success: function (result) 
				{
					if(result.msg_status == 1)
					{
						window.location=baseurl + 'dashboard';
					}
					else
					{
						
						$("#verifying-account").css("display","none");
						$("#loginBtn").css("display","block");
						$("#error_msg").text(result.msg_data);
					}
				 
				},
				error: function (jqXHR, exception) {
					var msg = '';
					if (jqXHR.status === 0) {
						msg = 'Not connect.\n Verify Network.';
					} else if (jqXHR.status == 404) {
						msg = 'Requested page not found. [404]';
					} else if (jqXHR.status == 500) {
						msg = 'Internal Server Error [500].';
					} else if (exception === 'parsererror') {
						msg = 'Requested JSON parse failed.';
					} else if (exception === 'timeout') {
						msg = 'Time out error.';
					} else if (exception === 'abort') {
						msg = 'Ajax request aborted.';
					} else {
						msg = 'Uncaught Error.\n' + jqXHR.responseText;
					}
					alert(msg);
				}
			});
		}	
		
		
	});
	


	
}); 


function loginRequired()
{
	var user_name = $("#user_name").val();
	var pass = $("#password").val();
	var captchavalue = $("#captchavalue").val();
	$("#error_msg").text("");	

	if(user_name=="")
	{
		$("#error_msg").text("Enter user name");
		$("#user_name").focus();
		return false;	
	}
	if(pass=="")
	{
		$("#error_msg").text("Enter password");
		$("#password").focus();
		return false;	
	}
	if(captchavalue=="")
	{
		$("#error_msg").text("Enter captch value");
		$("#captchavalue").focus();
		return false;	
	}	
	
	return true;
	
}

