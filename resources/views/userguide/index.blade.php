@extends('shopify-app::layouts.default')

@section('content')
    <section></section>
    <section class="full-width">
        <article>
            <div class="columns six">
                <h4>{{ config('shopify-app.app_name') }}</h4>
            </div>
            <div class=" columns six">
                <div class="align-right">
                    <a class="link" target="_blank" style="padding-right: 1rem;" href="https://support.extendons.com/">
                        <span>Get Support</span>
                    </a>
                    <a class="button back" href="{{ custom_route('settings') }}">Home</a>
                </div>
            </div>
        </article>
    </section>
    <section class="full-width">
        <article>
            <div class="card">
                <div class="card-section">
                    <div class="row">
                        <div class="columns twelve">
                            <div>
                                <div class="page-header">
                                    <h3
                                        style="color:#5F6DC5;font-family:'Open Sans Semibold';font-variant: small-caps; font-size:32px">
                                        How
                                        To Install {{ config('shopify-app.app_name') }}</h3>
                                    <hr class="notop">
                                </div>

                                <p>
                                    &nbsp;</p>
                                <p style="font-family:'Open Sans'; font-size:17px">
                                    Go to the <strong
                                        style="color:#5F6DC5;font-size:17px;font-family:'Open Sans Semibold'">Apps</strong>
                                    store. Here you will find the Redirect After & Login Signup App. Click on the <strong
                                        style="color:#5F6DC5;font-size:17px;font-family:'Open Sans Semibold'">Easy VAT
                                        Redirect After & Login Signup App </strong> and add it to your store.</p>
                                <p>
                                    &nbsp;</p>
                                <h4
                                    id="how_to_install_hide_bogo_discount_app_strong_style"font_family'open_sans_semibold'_font_size20px"demo_link_strong_nbspa_href"https://bogo-discount.myshopify.com/"_style"color_5f6dc5font_size17pxfont_family'open_sans_semibold'"https://bogo-discount.myshopify.com/_a">
                                    <strong style="font-family:'Open Sans Semibold'; font-size:20px">Demo
                                        Link:</strong>&nbsp;<a
                                        href="https://admin.shopify.com/store/extendons-redirect-after-login/"
                                        style="color:#5F6DC5;font-size:17px;font-family:'Open Sans Semibold'">https://admin.shopify.com/store/extendons-redirect-after-login/

                                    </a></h4>
                                <br />
                                <img alt="" src="assets/images/image_1.png">
                            </div>
                            <br>

                            <div>
                                <p class="Body">
                                    <span style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;; font-size: 25px; font-variant-caps: small-caps;">SELECT PLANS</span></p>
                                    <p style="font-family:'Open Sans'; font-size:17px">
                                    Select your desired plan and enter card details click on approve button for using the complete functionality of redirect after login app.
                                
                                </p>
                                <br>
                                <img alt="" src="assets/images/image_13.png">
                                <br><br>
                                <img alt="" src="assets/images/image_14.png">
                            </div>
                            <div>
                                <br>
                                <p class="Body">
                                    <span
                                        style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;; font-size: 25px; font-variant-caps: small-caps;">CONFIGURE
                                        DISPLAY SETTINGS OS 2.0</span>
                                </p>
                                <p style="font-family:'Open Sans'; font-size:17px">
                                    <strong style="color:#5F6DC5;font-size:17px;font-family:'Open Sans Semibold'">APPS
                                        EMBEDS</strong> At the admin dashboard, click on online store and select themes,
                                    click on customize. Click on customize button go to theme settings > App Embeds At apps
                                    embeds section here you can enable the redirect after login section.
                                </p>
                                <br>
                            </div>

                                <div>
                                    <p class="Body">
                                        <span style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;; font-size: 25px; font-variant-caps: small-caps;">Redirect After Registration</span></p>
                                        <p style="font-family:'Open Sans'; font-size:17px">
                                        Click on <strong style="color:#5F6DC5;font-size:17px;font-family:'Open Sans Semibold'">after registration tab </strong>  here you can configure the following settings.
                                    </p>
                                    <br/>
                                    <p class="Body">
                                        <span style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;; font-size: 25px; font-variant-caps: small-caps;">Add Rules</span></p>
                                    <p style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                        Here you will have to provide the following rule settings:</p>
                                    
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;">Add Rule :</strong>&nbsp; Option to creat new rule by clicking on the add rule button</li>
                                    </ul>
                                     
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;">Applied On :</strong>&nbsp; Option to select and apply rule on all customers</li>
                                    </ul>
                                     
                                    
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;">Redirect to :</strong>&nbsp;  Option to select and redirect Home page, product page, collection page, and last visit page. Here you can select desired page for redirect after registration. i.e specific product is selected in given image	</li>
                                    </ul>
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;"> Set Priority: </strong>&nbsp; Option to priority for each rule display 1,2,3 ...  </li>
                                    </ul>
                                <br>
                                <img alt="" src="assets/images/image_2.png">
                                <br>
                                </div>
                                <br>

                                <div>
                                    <p style="color:#5F6DC5;font-family:'Open Sans Semibold';font-variant: small-caps; font-size:25px">
                                        Update Rule &nbsp;</p>
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;">Rule Applied To: </strong>&nbsp;    Option to select and apply rule on all customers</li>
                                    </ul>
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;">Redirect To: </strong>&nbsp;    Option to select and redirect to Home, product, collection, page and last page</li>
                                    </ul>
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;">Rule Priority: </strong>&nbsp;  Set priority between same rules (1 has more priority) i.e rule priority is 2</li>
                                    </ul>
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;">Update Button: </strong>&nbsp;     Save all rule setting by click on the update button</li>
                                    </ul>
                                    <br>
                                    <img alt="" src="assets/images/image_3.png">
                                    <br><br>
                                    <img alt="" src="assets/images/image_4.png">
                                    <br>
                                </div>
                                <br>

                                <div>
                                    <p class="Body">
                                        <span style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;; font-size: 25px; font-variant-caps: small-caps;">Redirect After Login </span></p>
                                        <p style="font-family:'Open Sans'; font-size:17px">
                                        <strong style="color:#5F6DC5;font-size:17px;font-family:'Open Sans Semibold'">Click </strong> on after Login tab here you can configure the following settings.
                                    </p>
                                    <br/>
                                    <p class="Body">
                                        <span style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;; font-size: 25px; font-variant-caps: small-caps;">Add Rule</span></p>
                                    <p style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                        Here you will have to provide the following rule settings:</p>
                                    
                                    <p style="color:#5F6DC5;font-family:'Open Sans Semibold';font-variant: small-caps; font-size:25px">
                                        Rule Settings&nbsp;</p>
                                    
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;">Apply On :</strong>&nbsp; Option to select and apply rule on all customers or specific tags wholesaler, vendor etc	</li>
                                    </ul>
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;">Customers Tags :</strong>&nbsp;  Select specific customers tags for redirect after login </li>
                                    
                                    </ul>
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;">Redirect to :</strong>&nbsp;  Option to select and redirect to Home, product, collection, page and last page. Here you can select desired page for redirect after login. i.e select collection page for redirect after login	</li>
                                    </ul>
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;">Collection :</strong>&nbsp;  Option to select available collection i.e sale collection 	</li>
                                    </ul>
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;"> Set Priority: </strong>&nbsp; Option to priority for each rule display </li>
                                    </ul>
                                    <br>
                                    <img alt="" src="assets/images/image_5.png">
                                    <br><br>
                                </div>
                                <br>

                                <div>
                                    <p style="color:#5F6DC5;font-family:'Open Sans Semibold';font-variant: small-caps; font-size:25px">
                                        Update Rule &nbsp;</p>
                                    
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;">Apply On :</strong>&nbsp; Option to select and apply rule on all customers or specific tags wholesaler, vendor etc	</li>
                                    </ul>
                                     
                                    
                                    
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;">Customers Tags :</strong>&nbsp;  Select specific customers tags for redirect after login </li>
                                    
                                    </ul>
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;">Redirect to :</strong>&nbsp;  Option to select and redirect to Home, product, collection, page and last page. Here you can select desired page for redirect after login. i.e select collection page for redirect after login	</li>
                                    </ul>
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;">Collection :</strong>&nbsp;  Option to select available collection i.e sale collection 	</li>
                                    </ul>
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;"> Set Priority: </strong>&nbsp; Option to priority for each rule display </li>
                                    </ul>
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;">	Update Button: </strong>&nbsp;     Save all rule setting by click on the Update button</li>
                                    </ul>
                                    <br>
                                    <img alt="" src="assets/images/image_6.png">
                                    <br><br>
                                    <img alt="" src="assets/images/image_7.png">
                                    <br/>
                                </div>
                                <br>

                                <div>
                                    <p class="Body">
                                        <span style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;; font-size: 25px; font-variant-caps: small-caps;">Redirect After Logout</span></p>
                                        <p style="font-family:'Open Sans'; font-size:17px">
                                        <strong style="color:#5F6DC5;font-size:17px;font-family:'Open Sans Semibold'">Click </strong> on after Logout tab here you can configure the following settings.
                                    </p>
                                    <br/>
                                    <p class="Body">
                                        <span style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;; font-size: 25px; font-variant-caps: small-caps;">Add Rules</span></p>
                                    <p style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                        Here you will have to provide the following rule settings:</p>
                                    
                                    <p style="color:#5F6DC5;font-family:'Open Sans Semibold';font-variant: small-caps; font-size:25px">
                                        Rule Settings&nbsp;</p>
                                    
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;">Apply On :</strong>&nbsp; Option to select and apply rule on all customers or specific tags wholesaler, vendor etc	</li>
                                    </ul>
                                     
                                    
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;">Redirect to :</strong>&nbsp;  Option to select and apply on multiple page. Home, product, collection, page and last page. Here you can select desired page for redirect after logout 	</li>
                                    </ul>
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;"> Set Priority: </strong>&nbsp; Option to priority for each rule display </li>
                                    </ul>
                                    <br>
                                    
                                    <p style="color:#5F6DC5;font-family:'Open Sans Semibold';font-variant: small-caps; font-size:25px">
                                        Update Rule &nbsp;</p>
                                    
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;">Rule Applied To: </strong>&nbsp;    Option to select and apply rule on all customers or specific tags wholesaler, vendor etc</li>
                                    </ul>
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;">Redirect To: </strong>&nbsp;    Option to select and redirect to Home, product, collection, page and last page</li>
                                    </ul>
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;">Rule Priority: </strong>&nbsp;  Set priority between same rules (1 has more priority)</li>
                                    </ul>
                                    <ul>
                                        <li style="font-family: &quot;Open Sans&quot;; font-size: 17px;">
                                            <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;">	Update Button: </strong>&nbsp;     Save all rule setting by click on the save button</li>
                                    </ul>
                                    <br>
                                    <img alt="" src="assets/images/image_8.png">
                                    <br/>
                                </div>
                                <br>

                                <div>
                                    <p style="color:#5F6DC5;font-family:'Open Sans Semibold';font-variant: small-caps; font-size:25px">
                                        HOW TO Uninstalll Redirect After Login & Logout App &nbsp;</p>
                                        
                                    <p style="font-family:'Open Sans'; font-size:17px">
                                        At the admin dashboard, go to the  <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;">Apps</strong> section and uninstall the  Redirect After Login & Logout App</p>
                                    <br>
                                    <p style="color:#5F6DC5;font-family:'Open Sans Semibold';font-variant: small-caps; font-size:25px">
                                        DISCLAIMER &nbsp;</p>
                                    
                                    <p style="font-family:'Open Sans'; font-size:17px">
                                        It is highly recommended to back up your server files and database before installing this app.</p>
                                    <p style="font-family:'Open Sans'; font-size:17px">
                                        No responsibility will be taken for any adverse effects occurring during installation. </p>
                                    <p style="font-family:'Open Sans'; font-size:17px">
                                         <strong style="color: rgb(95, 109, 197); font-family: &quot;Open Sans Semibold&quot;;">It is recommended you install on a test server initially to carry out your own testing.</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>	
        </article>
    </section>
@endsection
