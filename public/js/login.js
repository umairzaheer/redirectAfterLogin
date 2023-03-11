$(document).ready(function () {

    $('table th').hover(()=>{
    $(this).css('cursor', 'pointer');
}, function() {
    $(this).css('cursor','auto');
});

    if ($('select[name="category"] option:selected').val() == "specific_tags") {
        $(".hide-show-section").show();
    } else {
        $(".hide-show-section").hide();
    }
    var redirect_to = $('select[name="redirect_to"] option:selected').val();
    if(redirect_to == "default" || redirect_to == "home" || redirect_to == "last_page") {
        $(".product-hide-show-section").hide();
    }
    else{
       $(".product-hide-show-section").show();
   }

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(document).on('click','ul.tabs li',function (e) {
        e.preventDefault();
        var tab_id = $(this).children().attr('href');
        var disabled= $(this).children().attr("disabled");
        jQuery('ul.tabs li').removeClass('active');
        jQuery('.tab-content').removeClass('current');
        jQuery('.tab-content').hide();
        jQuery(this).addClass('active');
        jQuery(tab_id).addClass('current');
        jQuery(tab_id).show();
      
    });

    $('#InsertModalLogin').find('select[name="category"]').change(function () {
        if ($(this).val() == "specific_tags") {
            $(".hide-show-section").show();
        } else {
            $(".hide-show-section").hide();
            $("#customers-login-add").empty();
        }
    });

    $('#EditModalLogin').find('select[name="category"]').change(function () {
        if ($(this).val() == "specific_tags") {
            $(".hide-show-section").show();
        } else {
            $(".hide-show-section").hide();
            $("#customers-login").empty();
        }
    });

       //Change function for Redirect add rule
            $('#InsertModalLogin').find('select[name="redirect_to"]').change(function(){
                let redirectLabel = $(this).val();
                if($(this).val() == "home" || $(this).val() == "last_page") {
                    $(".product-hide-show-section").hide();
                }
                else if($(this).val() == "default") {
                    $(".product-hide-show-section").hide();
                }
                else{
                    $('#InsertModalLogin').find("#redirectLabel").text(redirectLabel.charAt(0).toUpperCase() + redirectLabel.slice(1));
                    $(".product-hide-show-section").show();
                    $("#product-login-add").empty();
                }
            })
            //Change function for Redirect edit rule
            $('#EditModalLogin').find('select[name="redirect_to"]').change(function(){
            let redirectLabel = $(this).val();
            if($(this).val() == "home" || $(this).val() == "last_page" || $(this).val() == "default") {
            $(".product-hide-show-section").hide();
            $('#EditModalLogin').find("#custom-url").val("");
         }
          else{
            $('#EditModalLogin').find("#redirectLabel").text(redirectLabel.charAt(0).toUpperCase() + redirectLabel.slice(1));
            $('#EditModalLogin').find("#product-login").empty();
            $(".product-hide-show-section").show();
         }
        })

        $("#customers-login-add").select2({
            dropdownParent: $('#InsertModalLogin'),
            ajax: {
                url: "/get-all-customers-login",
                data: function (params) {
                    var query = {
                        term: params.term,
                        type: "public",
                    };
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data,
                    };
                },
            },
        });

    $("#customers-login").select2({
        dropdownParent: $('#InsertModalLogin'),
        ajax: {
            url: "/get-all-customers-login",
            data: function (params) {
                var query = {
                    term: params.term,
                    type: "public",
                };
                return query;
            },
            processResults: function (data) {
                return {
                    results: data,
                };
            },
        },
    });

    $("#product-login-add").select2({
        dropdownParent: $('#InsertModalLogin'),
        ajax: {
            url: "/get-all-products",
            data: function (params) {
                var type = $('#InsertModalLogin').find('select[name="redirect_to"] option:selected').val();
                var query = {
                    term: params.term,
                    type: type,
                };
                return query;
            },
            processResults: function (data) {
                return {
                    results: data,
                };
            },
        },
    });
    
    $('#EditModalLogin').find("#product-login").select2({
        dropdownParent: $('#EditModalLogin'),
        ajax: {
            url: "/get-all-products",
            data: function (params) {
                var type =  $('#EditModalLogin').find('select[name="redirect_to"] option:selected').val();
                var query = {
                    term: params.term,
                    type: type,
                };
                return query;
            },
            processResults: function (data) {
                return {
                    results: data,
                };
            },
        },
    });

    $(".add-login-rule").on("click", function (e) {
        e.preventDefault();
        $("#login-form").trigger("reset");
        let ActiveTab = $('ul.tabs').find('li.active').find('span.tabs-title').text();
        if(ActiveTab == "After Registration"){
            $("option[value='specific_tags']").hide();
        }
        else{
            $("option[value='specific_tags']").show();
        }
        
        $("#product-login").empty();
        $("#customers-login-add").empty();
        $(".hide-show-section").hide();
        $(".product-hide-show-section").hide();
        $("#InsertModalLogin").show();
        $("#InsertModalLogin").css('display','flex');
        // $("body").css('overflow', 'hidden');
    });

    $(".login-cancel-btn").on("click", function (e) {
        $('#DeleteModalLogin').hide();
        $('#EditModalLogin').hide();
        $('#InsertModalLogin').hide();
        // $("body").css('overflow', 'auto');
     });

     $(".login-modal-close-btn").on("click", function (e) {
        $('#DeleteModalLogin').hide();
        $('#EditModalLogin').hide();
        $('#InsertModalLogin').hide();
        // $("body").css('overflow', 'auto');
     });

    $("#login-form").submit(function (e) {
        e.preventDefault(); 
        var data = new FormData(this);
        var appendCtag = data.getAll('customer_category[]');
        var value = data.append('rule_for',$('ul.tabs').find('li.active').find('span.tabs-title').attr('data-name'));
        $.ajax({
            type: "post",
            url: "/save-login",
            data: data,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status == 200) {
                    $('#InsertModalLogin').hide();
                    windowScroll();
                    $('#check_login_value').val(response.ruleId);
                    $("#success_message").show();
                    $("#success_message").addClass("alert success");
                    $("#success_message").text(response.message);
                    // $("body").css('overflow', 'auto');
                    setTimeout(function () {
                        $("#success_message").fadeOut("slow");
                    }, 2000);
                    var appendData;
                    var hideRow;
                     var data= response.data;
                     if(data.rule_for == 'login'){
                        appendData = "search-data-login";
                        hideRow = "login-table";
                        $(".no-record-hide-login").hide();
                     }
                     else if(data.rule_for == 'logout'){
                         appendData = "search-data-logout";
                         hideRow = "logout-table";
                         $(".no-record-hide-logout").hide();
                     }
                     else if(data.rule_for == "registration"){
                        appendData = "search-data-registration";
                        hideRow = "registration-table";
                        $(".no-record-hide-registration").hide();
                    }
                    //check for the first record entered
                    if (response.count == 1) {
                        if (response.ctag){
                                 var customerTags = "";
                                 for (var i = 0; i<appendCtag.length; i++){
                                    customerTags += "<span class = 'tag grey'>" + appendCtag[i] + "</span>";
                                }
                                        $("#"+appendData).append(
                                        "<tr id="+ data.id +">\
                                         <td><span class= 'highlight-warning'>" + data.id + "</span></td>\
                                         <td>" + data.category + "</td>\
                                         <td>" +customerTags+ "</td>\
                                         <td>" + data.redirect_to + "</td>\
                                         <td>" + data.priority + "</td>\
                                         <td><button value='" + data.id + "' class='secondary icon-edit edit-rule' id= 'edit-rule' data-id = '" +  data.id +"'></button>\
                                         <button value='" + data.id + "' class='secondary icon-trash' id = 'delete-rule'></button></td>\
                                        </tr>");
                                        if(data.rule_for == 'login'){
                                            $("#load-login-data").load('/first-login-record');
                                        }
                                       else if(data.rule_for == 'logout'){
                                            $("#load-logout-data").load('/first-logout-record');
                                        } 
                                        else if(data.rule_for == 'registration'){
                                            $("#load-registration-data").load('/first-registration-record');
                                        }
                                    }
                                    else{
                                        //this check is to resolve registration table design issue
                                        if(data.rule_for == 'registration'){
                                            $("#"+appendData).append(
                                                "<tr id="+ data.id +">\
                                                 <td><span class= 'highlight-warning'>" + data.id + "</span></td>\
                                                 <td>" + data.category + "</td>\
                                                 <td>" + data.redirect_to + "</td>\
                                                 <td>" + data.priority + "</td>\
                                                 <td><button value='" + data.id + "' class='secondary icon-edit edit-rule' id= 'edit-rule' data-id = '" +  data.id +"'></button>\
                                                 <button value='" + data.id + "' class='secondary icon-trash' id = 'delete-rule'></button></td>\
                                                </tr>");
                                        }
                                        else{
                                        $("#"+appendData).append(
                                      "<tr id="+ data.id +">\
                                       <td><span class= 'highlight-warning'>" + data.id + "</span></td>\
                                       <td>" + data.category + "</td>\
                                       <td></td>\
                                       <td>" + data.redirect_to + "</td>\
                                       <td>" + data.priority + "</td>\
                                       <td><button value='" + data.id + "' class='secondary icon-edit edit-rule' id= 'edit-rule' data-id = '" +  data.id +"'></button>\
                                       <button value='" + data.id + "' class='secondary icon-trash' id = 'delete-rule'></button></td>\
                                      </tr>");
                                        }
                                        if(data.rule_for == 'login'){
                                            $("#load-login-data").load('/first-login-record');
                                        }
                                        else if(data.rule_for == 'logout'){
                                            $("#load-logout-data").load('/first-logout-record');
                                        } 
                                        else if(data.rule_for == 'registration'){
                                            $("#load-registration-data").load('/first-registration-record');
                                        }
                                    }
                                } else{
                                    if (response.ctag){
                                        if(data.rule_for == 'login'){
                                            $("#load-login-data").load('/first-login-record');
                                        }
                                        else if(data.rule_for == 'logout'){
                                            $("#load-logout-data").load('/first-logout-record');
                                        } 
                                        else if(data.rule_for == 'registration'){
                                            $("#load-registration-data").load('/first-registration-record');
                                        }
                                    }
                                    else {
                                    if(data.rule_for == 'login'){
                                        $("#load-login-data").load('/first-login-record');
                                    }
                                    else if(data.rule_for == 'logout'){
                                        $("#load-logout-data").load('/first-logout-record');
                                    } 
                                    else if(data.rule_for == 'registration'){
                                        $("#load-registration-data").load('/first-registration-record');
                                    }
                                }
                            }
                        } else {
                            windowScroll();
                            validationErrorLogin(response);
                            setTimeout(function () {
                                $(".customer_login_error").fadeOut("slow");
                            }, 2000);
                        }
                    },
                });
            });
            
            $(document).on("click", '.edit-rule' , function (e) {
            e.preventDefault();
            $("body").css('overflow', 'hidden');
            let ActiveTab = $('ul.tabs').find('li.active').find('span.tabs-title').text();
            if(ActiveTab == "After Registration"){
            $("option[value='specific_tags']").hide();
            }
            else{
            $("option[value='specific_tags']").show();
            }
            var id = $(this).attr("data-id");
            $.ajax({
                type: "GET",
                url: "edit-login/" + id,
                dataType: "json",
                success: function (response) {
                    var res = response.data;
                    $("#update-login-form").trigger("reset");
                    windowScroll();
                    $('#EditModalLogin').find("#check_login_value").val(response.ruleId);
                    $('#EditModalLogin').find('select#category-login-edit').val(res.category);
                    if(res.customer_tags != ""){
                        $(".hide-show-section").show();
                    }
                    else{
                        $(".hide-show-section").hide();
                    }
                    $('#EditModalLogin').find('select#redirect-login').val(res.redirect_to);
                    if(res.redirect_to == "default" || res.redirect_to == "home" || res.redirect_to == "last_page"){
                        $(".product-hide-show-section").hide();
                    }
                    else{
                        $('#EditModalLogin').find("#redirectLabel").text(res.redirect_to.charAt(0).toUpperCase() + res.redirect_to.slice(1));
                        $(".product-hide-show-section").show();
                    }
                    var redirectData = {
                        id: response.id,
                        text: response.text,
                    };
                    var option = new Option(redirectData.text, redirectData.id, false, true);
                     $('#EditModalLogin').find('#product-login').append(option).trigger('change');
                    $('#EditModalLogin').find('#priority-login-edit').val(res.priority);
                    $('#EditModalLogin').show();
                    $('#EditModalLogin').css('display', 'flex');
                    $('#EditModalLogin').find('#customers-login').html("");
                    res.customer_tags.forEach(function (tag){
                        var data = {
                            id: tag.customer_tag,
                            text: tag.customer_tag,
                        };
                        var newOption = new Option(data.text, data.id, false, true);
                        $('#EditModalLogin').find('#customers-login').append(newOption).trigger('change');
                    })
                },
            });
        });
        
        $("#customers-login").select2({
        dropdownParent: $('#EditModalLogin'),
        ajax: {
            url: "/get-all-customers-login",
            data: function (params) {
                var query = {
                    term: params.term,
                    type: "public",
                };
                return query;
            },
            processResults: function (data) {
                return {
                    results: data,
                };
            },
        },
    });
    
    $("#update-login-form").submit(function (e) {
        e.preventDefault(); 
        var data = new FormData(this);
        var appendCtag = data.getAll('customer_category[]');
        var id = $("#check_login_value").val();
        $.ajax({
            type: "post",
            url: "/update-login/" + id,
            data: data,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status == 200) {
                    $('#EditModalLogin').hide();
                    windowScroll();
                    $('#check_login_value').val(response.ruleId);
                    $("#success_message").show();
                    $("#success_message").addClass("alert success");
                    $("#success_message").text(response.message);
                    // $("body").css('overflow', 'auto');
                    setTimeout(function () {
                        $("#success_message").fadeOut("slow");
                    }, 2000);
                    var appendData;
                    var hideRow;
                     var data= response.data;
                     var redirectValue;
                     var category;
                     if(data.category == "all_customers"){
                         category = "All Customers";
                     }
                     else if(data.category == "specific_tags"){
                        category = "Specific Tags";
                     }
                     if(data.redirect_to == "last_page"){
                        redirectValue = "Last Page";
                     }
                     else {
                        redirectValue = data.redirect_to.charAt(0).toUpperCase() + data.redirect_to.slice(1);
                     }
                     if(data.rule_for == 'login'){
                        appendData = "search-data-login";
                        hideRow = "login-table";
                     }
                     else if(data.rule_for == 'logout'){
                         appendData = "search-data-logout";
                         hideRow = "logout-table";
                     }
                     else if(data.rule_for == "registration"){
                        appendData = "search-data-registration";
                         ("tr#"+data.id).replaceWith(
                            "<tr id="+ data.id +">\
                             <td><span class= 'highlight-warning'>" + data.id + "</span></td>\
                             <td>" + data.category + "</td>\
                             <td>" + data.redirect_to + "</td>\
                             <td>" + data.priority + "</td>\
                             <td><button value='" + data.id + "' class='secondary icon-edit edit-rule' id= 'edit-rule' data-id = '" +  data.id +"'></button>\
                             <button value='" + data.id + "' class='secondary icon-trash' id = 'delete-rule'></button></td>\
                            </tr>");
                    }
                    if (response.ctag){
                             var customerTags = "";
                             for (var i = 0; i<appendCtag.length; i++){
                                customerTags += "<span class = 'tag grey'>" + appendCtag[i] + "</span>";
                            }
                            $("tr#"+data.id).replaceWith(
                                "<tr id="+ data.id +">\
                                <td><span class= 'highlight-warning'>" + data.id + "</span></td>\
                                <td>" + category + "</td>\
                                <td>" +customerTags+ "</td>\
                                <td>" + redirectValue + "</td>\
                                <td>" + data.priority + "</td>\
                                <td><button value='" + data.id + "' class='secondary icon-edit edit-rule' id= 'edit-rule' data-id = '" +  data.id +"'></button>\
                                <button value='" + data.id + "' class='secondary icon-trash' id = 'delete-rule'></button></td>\
                                </tr>");
                            }
                            else{
                                $("tr#"+data.id).replaceWith(
                                    "<tr id="+ data.id +">\
                                    <td><span class= 'highlight-warning'>" + data.id + "</span></td>\
                                    <td>" + category + "</td>\
                                    <td></td>\
                                    <td>" + redirectValue + "</td>\
                                    <td>" + data.priority + "</td>\
                                    <td><button value='" + data.id + "' class='secondary icon-edit edit-rule' id= 'edit-rule' data-id = '" +  data.id +"'></button>\
                                    <button value='" + data.id + "' class='secondary icon-trash' id = 'delete-rule'></button></td>\
                                    </tr>");
                                }
                            } 
                            else {
                                $("#success_message").show();
                                windowScroll();
                                validationErrorLogin(response);
                            }
                        },
                        complete: function(){}
                    });
                });
                
                $(document).on("click", "#delete-rule", function () {
                    var rule_id = $(this).val();
                    $("#delete-id-login").val(rule_id);
                    windowScroll();
                    $('#DeleteModalLogin').show();
                    $("body").css('overflow', 'hidden');
                    $("#DeleteModalLogin").css('display','flex');
                });
                
                $(document).on("click", "#delete-rule-login", function (e) {
                    e.preventDefault();
                    var id = $("#delete-id-login").val();
                    $.ajax({
                        type: "DELETE",
                        url: "/delete-login-rule/" + id,
                        dataType: "json",
                        success: function (data) {
                            $("tr#"+data.id).remove();
                            $("#success_message").show();
                            $("#success_message").addClass("alert success");
                            $("#success_message").text(data.message);
                            // $("body").css('overflow', 'auto');
                            setTimeout(function () {
                                $("#success_message").fadeOut("slow");
                            }, 2000);
                            $("#DeleteModalLogin").hide("");
                            if(data.ruleFor == 'login'){
                                $("#load-login-data").load('/first-login-record');
                            }
                            else if(data.ruleFor == 'logout'){
                                $("#load-logout-data").load('/first-logout-record');
                            } 
                            else if(data.ruleFor == 'registration'){
                                $("#load-registration-data").load('/first-registration-record');
                            }
                        },
                    });
                });
                
                $(document).on("keyup", '#login-search' , function (e) {
                    var value = $(this).val();
                    var activeTab = $('ul.tabs').find('li.active').find('span.tabs-title').attr("data-name");
                    $.ajax({
                        type: "get",
                        dataType: "json",
                        url: "/pagination",
                        data: {
                            search: value,
                            activeTab: activeTab
                        },
                        success: function (response) {
                            var data= response.data.data;
                            if(response.data.data.length === 0){
                                $("#search-data-login").html("<tr><td colspan='3'> No Data Available</td></tr>");
                                $(".pagination").hide();
                            }else{
                                $("#search-data-login").html("");
                                data.forEach(function (item) {
                                    var redirectTo;
                                    var category;
                                    if(item.category == "all_customers"){
                                        category = "All Customers";
                                    }
                                    else if(item.category == "specific_tags"){
                                       category = "Specific Tags";
                                    }

                                    if(item.redirect_to == 'default'){
                                        redirectTo = 'Default';
                                    } else if(item.redirect_to == 'home'){
                                        redirectTo = 'Home';
                                    } else if(item.redirect_to == 'product'){
                                        redirectTo = 'Product';
                                    } else if(item.redirect_to == 'collection'){
                                        redirectTo = 'Collection';
                                    } else if(item.redirect_to == 'page'){
                                        redirectTo = 'Page';
                                    } else if(item.redirect_to == 'last_page'){
                                        redirectTo = 'Last Page';
                                    } 
                                    var customerTags = "";
                                    item.customer_tags.forEach(function (tags) {
                                        customerTags += "<span class = 'tag grey'>" + tags.customer_tag + "</span>";
                                    });
                                    
                                    $("#search-data-login").append(
                                        "<tr id="+ item.id +">\
                                        <td><span class= 'highlight-warning'>" + item.id + "</span></td>\
                                        <td>" + category + "</td>\
                                        <td>" +customerTags+ "</td>\
                                        <td>" + redirectTo + "</td>\
                                        <td>" + item.priority + "</td>\
                                        <td><button value='" + item.id + "' class='secondary icon-edit edit-rule' id= 'edit-login' data-id = '" +  item.id +"'></button>\
                                        <button value='" + item.id + "' class='secondary icon-trash' id = 'delete-rule'></button></td>\
                                        </tr>"
                                        );
                                        $("#search-data-login").next().css('display','none');
                                        $("#login-pagination").html("");
                                        $("#login-pagination").append(response['pagination']);
                                    });
                                }
                            },
                            complete: function(){}
                        });
                    });
                    
                    $(document).on("keyup", '#logout-search' , function (e) {
                        var value = $(this).val();
                        var activeTab = $('ul.tabs').find('li.active').find('span.tabs-title').attr("data-name");
                        $.ajax({
                            type: "get",
                            url: "/pagination",
                            data: {
                                search: value,
                                activeTab: activeTab
                            },
                            success: function (response) {
                                var data= response.data.data;
                                if(response.data.data.length === 0){
                                    $("#search-data-logout").html("<tr><td colspan='3'> No Data Available</td></tr>");
                                    $("#logout-pagination").hide();
                                }else{
                                    $("#search-data-logout").html("");
                                    data.forEach(function (item) {
                                        var redirectTo;
                                        var category;
                                        if(item.category == "all_customers"){
                                            category = "All Customers";
                                        }
                                        else if(item.category == "specific_tags"){
                                            category = "Specific Tags";
                                        }

                                        if(item.redirect_to == 'default'){
                                            redirectTo = 'Default';
                                        } else if(item.redirect_to == 'home'){
                                            redirectTo = 'Home';
                                        } else if(item.redirect_to == 'product'){
                                            redirectTo = 'Product';
                                        } else if(item.redirect_to == 'collection'){
                                            redirectTo = 'Collection';
                                        } else if(item.redirect_to == 'page'){
                                            redirectTo = 'Page';
                                        } else if(item.redirect_to == 'last_page'){
                                            redirectTo = 'Last Page';
                                        }
                                        var customerTags = "";
                                        item.customer_tags.forEach(function (tags) {
                                            customerTags += "<span class = 'tag grey'>" + tags.customer_tag + "</span>";
                                        });
                                        
                                        $("#search-data-logout").append(
                                            "<tr id="+ item.id +">\
                                            <td><span class= 'highlight-warning'>" + item.id + "</span></td>\
                                            <td>" + category + "</td>\
                                            <td>" +customerTags+ "</td>\
                                            <td>" + redirectTo + "</td>\
                                            <td>" + item.priority + "</td>\
                                            <td><button value='" + item.id + "' class='secondary icon-edit edit-rule' id= 'edit-rule' data-id = '" +  item.id +"'></button>\
                                            <button value='" + item.id + "' class='secondary icon-trash' id = 'delete-rule'></button></td>\
                                            </tr>"
                                            );
                                            $("#search-data-logout").next().css('display','none');
                                            $("#logout-pagination").html("");
                                            $("#logout-pagination").append(response['pagination']);
                                        });
                                    }
                                },
                                complete: function(){}
                            });
                        });
                        
                        $(document).on("keyup", '#registration-search' , function (e) {
                            var value = $(this).val();
                            var activeTab = $('ul.tabs').find('li.active').find('span.tabs-title').attr("data-name");
                            $.ajax({
                                type: "get",
                                url: "/pagination",
                                data: {
                                    search: value,
                                    activeTab: activeTab
                                },
                                success: function (response) {
                                    var data= response.data.data;
                                    if(response.data.data.length === 0){
                                        $("#search-data-registration").html("<tr><td colspan='3'> No Data Available</td></tr>");
                                        $("#registration-pagination").hide();
                                    }else{
                                        $("#search-data-registration").html("");
                                        data.forEach(function (item) {
                                            var redirectTo;
                                            var category;
                                            if(item.category == "all_customers"){
                                                category = "All Customers";
                                            }
                                            else if(item.category == "specific_tags"){
                                                category = "Specific Tags";
                                            }
                                            if(item.redirect_to == 'default'){
                                                redirectTo = 'Default';
                                            } else if(item.redirect_to == 'home'){
                                                redirectTo = 'Home';
                                            } else if(item.redirect_to == 'product'){
                                                redirectTo = 'Product';
                                            } else if(item.redirect_to == 'collection'){
                                                redirectTo = 'Collection';
                                            } else if(item.redirect_to == 'page'){
                                                redirectTo = 'Page';
                                            } else if(item.redirect_to == 'last_page'){
                                                redirectTo = 'Last Page';
                                            }
                                            $("#search-data-registration").append(
                                                "<tr id="+ item.id +">\
                                                <td><span class= 'highlight-warning'>" + item.id + "</span></td>\
                                                <td>" + category + "</td>\
                                                <td>" + redirectTo + "</td>\
                                                <td>" + item.priority + "</td>\
                                                <td><button value='" + item.id + "' class='secondary icon-edit edit-rule' id= 'edit-registration' data-id = '" +  item.id +"'></button>\
                                                <button value='" + item.id + "' class='secondary icon-trash' id = 'delete-rule'></button></td>\
                                                </tr>"
                                                );
                                                $("#search-data-registration").next().css('display','none');
                                                $("#registration-pagination").html("");
                                                $("#registration-pagination").append(response['pagination']);
                                            });
                                        }
                                    },
                                    complete: function(){}
                                });
                            });
                            
                            $(document).on("click", ".pagination a", function (event) {
                                event.preventDefault();
                                var page = $(this).attr("href").split("page=")[1];
                                fetch_data(page);
                            });
                            
                            $(document).on("click", ".logout-pagination a", function (event) {
                                event.preventDefault();
                                var page = $(this).attr("href").split("page=")[1];
                                fetch_data(page);
                            });
                            
                            $(document).on("click", ".registration-pagination a", function (event) {
                                 event.preventDefault();
                                 var page = $(this).attr("href").split("page=")[1];
                                 fetch_data(page);
                                });
                                
                                function fetch_data(page) {
                                    var loginValue = $("#login-search").val();
                                    var logoutValue = $("#logout-search").val();
                                    var registrationValue = $("#registration-search").val();
                                    var activeTab = $('ul.tabs').find('li.active').find('span.tabs-title').attr("data-name");
                                    $.ajax({
                                        url: "/pagination",
                                        method: "GET",
                                        dataType: "json",
                                        data: {
                                            page: page,
                                            loginSearch:loginValue,
                                            logoutSearch:logoutValue,
                                            registrationSearch:registrationValue,
                                            activeTab:activeTab
                                        },
                                        success: function (response) {
                                            var data= response.data.data;
                                            var searchPaginationData;
                                            var paginationButton;
                                            if(response.searchPaginationData == "search-data-login"){
                                                searchPaginationData = response.searchPaginationData;
                                                paginationButton = response.paginationBtn;
                                            } else if(response.searchPaginationData == "search-data-logout"){
                                                searchPaginationData = response.searchPaginationData;
                                                paginationButton = response.paginationBtn;
                                            }
                                            else if(response.searchPaginationData == "search-data-registration"){
                                                searchPaginationData = response.searchPaginationData;
                                                paginationButton = response.paginationBtn;
                                            }
                                            if(response.searchPaginationData == "search-data-registration"){
                                                $("#"+searchPaginationData).html("");
                                                data.forEach(function (item) {
                                                    var redirectTo;
                                                    var category;
                                                    if(item.category == "all_customers"){
                                                        category = "All Customers";
                                                    }
                                                    else if(item.category == "specific_tags"){
                                                       category = "Specific Tags";
                                                    }

                                                    if(item.redirect_to == 'default'){
                                                        redirectTo = 'Default';
                                                    } else if(item.redirect_to == 'home'){
                                                        redirectTo = 'Home';
                                                    } else if(item.redirect_to == 'product'){
                                                        redirectTo = 'Product';
                                                    } else if(item.redirect_to == 'collection'){
                                                        redirectTo = 'Collection';
                                                    } else if(item.redirect_to == 'page'){
                                                        redirectTo = 'Page';
                                                    } else if(item.redirect_to == 'last_page'){
                                                        redirectTo = 'Last Page';
                                                    }
                                                    $("#"+searchPaginationData).append(
                                                        "<tr id="+ item.id +">\
                                                        <td><span class= 'highlight-warning'>" + item.id + "</span></td>\
                                                        <td>" + category + "</td>\
                                                        <td>" + redirectTo + "</td>\
                                                        <td>" + item.priority + "</td>\
                                                        <td><button value='" + item.id + "' class='secondary icon-edit edit-rule' id= 'edit-login' data-id = '" +  item.id +"'></button>\
                                                        <button value='" + item.id + "' class='secondary icon-trash' id = 'delete-rule'></button></td>\
                                                        </tr>"
                                                        );
                                                        $("#"+searchPaginationData).next().css('display','none');
                                                        $("#"+paginationButton).html("");
                                                        $("#"+paginationButton).append(response['pagination']);
                                                    });
                                                }
                                                else {
                                                    $("#"+searchPaginationData).html("");
                                                    data.forEach(function (item) {
                                                        var redirectTo;
                                                        var category;
                                                        if(item.category == "all_customers"){
                                                            category = "All Customers";
                                                        }
                                                        else if(item.category == "specific_tags"){
                                                           category = "Specific Tags";
                                                        }

                                                        if(item.redirect_to == 'default'){
                                                            redirectTo = 'Default';
                                                        } else if(item.redirect_to == 'home'){
                                                            redirectTo = 'Home';
                                                        } else if(item.redirect_to == 'product'){
                                                            redirectTo = 'Product';
                                                        } else if(item.redirect_to == 'collection'){
                                                            redirectTo = 'Collection';
                                                        } else if(item.redirect_to == 'page'){
                                                            redirectTo = 'Page';
                                                        } else if(item.redirect_to == 'last_page'){
                                                            redirectTo = 'Last Page';
                                                        }
                                                        var customerTags = "";
                                                        item.customer_tags.forEach(function (tags) {
                                                            customerTags += "<span class = 'tag grey'>" + tags.customer_tag + "</span>";
                                                        });
                                                        $("#"+searchPaginationData).append(
                                                            "<tr id="+ item.id +">\
                                                            <td><span class= 'highlight-warning'>" + item.id + "</span></td>\
                                                            <td>" + category + "</td>\
                                                            <td>" +customerTags+ "</td>\
                                                            <td>" + redirectTo + "</td>\
                                                            <td>" + item.priority + "</td>\
                                                            <td><button value='" + item.id + "' class='secondary icon-edit edit-rule' id= 'edit-login' data-id = '" +  item.id +"'></button>\
                                                            <button value='" + item.id + "' class='secondary icon-trash' id = 'delete-rule'></button></td>\
                                                            </tr>"
                                                            );
                                                            $("#"+searchPaginationData).next().css('display','none');
                                                            $("#"+paginationButton).html("");
                                                            $("#"+paginationButton).append(response['pagination']);
                                                        });
                                                    }
                                                },
                                                complete: function(){}
                                            });
                                        }
                                        
                                        function windowScroll() {
                                            window.scroll({
                                                top: 0,
                                                left: 0,
                                                behavior: "smooth",
                                            });
                                        }
                                        
                                        function validationErrorLogin(response){
                                            $.each(response.errors ,function(prefix, val){
                                                $('span.'+prefix+'_error').text(val[0]).css("color", "red").show();
                                                $('span.'+prefix+'_error').text(val[0]).fadeIn(100).delay(3000).hide(100);
                                            }); 
                                        }

});