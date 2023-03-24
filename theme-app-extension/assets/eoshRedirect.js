var domain = Shopify.shop;
var baseUrl = "https://sf-redirectafterlogin.extendons.com/";
(function () {
  var loadScript = function (url, callback) {
    var script = document.createElement("script");
    script.type = "text/javascript";
    if (script.readyState) {
      script.onreadystatechange = function () {
        if (script.readyState == "loaded" || script.readyState == "complete") {
          script.onreadystatechange = null;
          callback();
        }
      };
    } else {
      script.onload = function () {
        callback();
      };
    }
    script.src = url;
    document.getElementsByTagName("head")[0].appendChild(script);
  };
  var eoshRedirect = function ($) {
    $(document).ready(function () {
      var login = document.getElementById("customer_login");
      if (login) {
        $("#CustomerEmail").change(function () {
          var disableLoginButton= $('#customer_login').find(":submit");
          $(disableLoginButton).css("pointer-events", "none");
          var email = document.getElementById("CustomerEmail").value;
          let data = [];
          var fieldHTML = "";
          $.ajax({
            url: baseUrl + "api/get-login-data",
            type: "GET",
            dataType: "json",
            crossDomain: true,
            data: { shop: domain, email: email },
            success: function (response) {
              $(disableLoginButton).css("pointer-events", "all");
              data = response;
              if (
                data.msg == true &&
                data.default == false &&
                data.last_page != true
              ) {
                fieldHTML =
                  '<input type="hidden" name="checkout_url" value="' +
                  data.redirect_url +
                  '">';
                $("#customer_login").append(fieldHTML);
              }
              if (data.last_page == true) {
                lastUrl = getCookie("eoshLastUrl");
                fieldHTML =
                  '<input type="hidden" name="checkout_url" value="' +
                  lastUrl +
                  '">';
                $("#customer_login").append(fieldHTML);
              }
            },
          });
        });
      }
      var logout = document.querySelector('a[href^="/account/logout"]');
      $('a[href^="/account/logout"]').addClass('logout-redirect');
      var logoutClass=document.querySelector('.logout-redirect');
      if (logout) {
        var logoutLink = logout.href;
        $('a[href^="/account/logout"]').css("pointer-events", "none");
        let customerId = __st.cid;
        $.ajax({
          url: baseUrl + "api/get-logout-data",
          type: "GET",
          dataType: "json",
          crossDomain: true,
          data: { shop: domain, cid: customerId },
          success: function (data) {
            $('a[href^="/account/logout"]').css("pointer-events", "all");
            if (data.msg == true && data.default == false) {
              $('a[href^="/account/logout"]').removeAttr('href');
              $('.logout-redirect').css("cursor", "pointer");
              $('.logout-redirect').click(function(e)
                {
                fetch(logoutLink).then(()=> (window.location.href = data.redirect_url ));
              });
            }
            if (data.last_page == true) {
              lastUrl = getCookie("eoshLastUrl");
              $('a[href^="/account/logout"]').removeAttr('href');
              $('.logout-redirect').css("cursor", "pointer");
              $('.logout-redirect').click(function(e)
                {
                  fetch(logoutLink).then(()=> (window.location.href = lastUrl ));
              });
            }
          },
        });
      }
      var registration =
          '#create_customer, form[action$="/account"][method="post"]',
        formRegistration = document.querySelectorAll(registration)[0];
      if (formRegistration) {
        $.ajax({
          url: baseUrl + "api/get-registration-data",
          type: "GET",
          dataType: "json",
          crossDomain: true,
          data: { shop: domain },
          success: function (response) {
            data = response;
            if (data.msg == true && data.default == false) {
              fieldHTML =
                '<input type="hidden" name="return_to" value="' +
                data.redirect_url +
                '">';
              $("#create_customer").append(fieldHTML);
            }
            if (data.last_page == true) {
              lastUrl = getCookie("eoshLastUrl");
              fieldHTML =
                '<input type="hidden" name="checkout_url" value="' +
                lastUrl +
                '">';
              $("#customer_login").append(fieldHTML);
            }
          },
        });
      }
      if (!formRegistration && !logoutClass && !login) {
        setCookie(
          "eoshLastUrl",
          window.location.pathname + window.location.search,
          365
        );
      }
      function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
        let expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
      }
      function getCookie(cname) {
        let name = cname + "=";
        let ca = document.cookie.split(";");
        for (let i = 0; i < ca.length; i++) {
          let c = ca[i];
          while (c.charAt(0) == " ") {
            c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
          }
        }
        return "";
      }
    });
  };
  if (typeof jQuery === "undefined" || parseFloat(jQuery.fn.jquery) < 1.7) {
    loadScript(
      "//ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js",
      function () {
        jQuery191 = jQuery.noConflict(true);
        eoshRedirect(jQuery191);
      }
    );
  } else {
    eoshRedirect(jQuery);
  }
})();
