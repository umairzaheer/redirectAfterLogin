<div id="InsertModalLogin" class="modalDialog align-center">
    <div>
        <article class="row" style="margin-top:10px">
            <div class="columns three align-left">
                <h5>Add Rule</h5>
            </div>
            <div class="columnns nine">
                <a href="#close" title="Close" class="close login-modal-close-btn">X</a>
            </div>
        </article>

        {!! Form::open(['id' => 'login-form']) !!}
        <div class="row">
            <article>
                <div class="columns three align-left">
                    {!! Form::label('category', 'Apply on', ['class' => 'awesome']) !!}
                </div>
                <div class="columns nine alignment">
                    {!! Form::select('category', ['all_customers' => 'All Customers', 'specific_tags' => 'Specific tags'], null, [
                        'id' => 'category',
                        'class' => 'categories',
                    ]) !!}
                </div>
            </article>
        </div>

        <div class="row hide-show-section" style="display:none;">
            <article>
                <div class="columns three align-left">
                    {!! Form::label('setting', 'Customer tags', ['class' => 'awesome']) !!}
                </div>
                <div class="columns nine alignment">
                    {!! Form::select('customer_category[]', [], null, [
                        'id' => 'customers-login-add',
                        'class' => 'form-control customers',
                        'multiple' => 'multiple',
                    ]) !!}
                    <span class="text-danger error-text customer_category_error"></span>
                </div>
            </article>
        </div>

        <div class="row">
            <article>
                <div class="columns three align-left">
                    {!! Form::label('redirect', 'Redirect to', ['class' => 'awesome']) !!}
                </div>
                <div class="columns nine alignment">
                    {!! Form::select('redirect_to', ['default' => 'Default', 'home' => 'Home', 'product' => 'Product', 'collection' =>'Collection', 'page' =>'Page', 'last_page' =>'Last Page'], null, [
                        'id' => 'redirect-login',
                        'class' => 'redirect',
                        ]) !!}
                </div>
            </article>
        </div>

        <div class="row product-hide-show-section" style="display:none;">
            <article>
                <div class="columns three align-left">
                    {!! Form::label('Product', 'Product', ['class' => 'awesome','id'=>'redirectLabel']) !!}
                </div>
                <div class="columns nine alignment">
                    {!! Form::select('redirect_value', [], null, [
                        'id' => 'product-login-add',
                        'class' => 'form-control product select4', 
                    ]) !!}
                    <span class="text-danger error-text redirect_value_error"></span>
                </div>
            </article>
        </div>

        <div class="row">
            <article>
                <div class="columns three align-left">
                    {!! Form::label('priority', 'Priority', ['class' => 'awesome']) !!}
                </div>
                <div class="columns nine">
                    {!! Form::selectRange('priority', 1, 10, ['class' => 'form-control priority']) !!}
                </div>
            </article>
        </div>

        <div class="row">
            <article>
                <div class="columns three">
                </div>
                <div class="columns nine align-right">
                    {{-- <input type="hidden" name="checkLogin" value="" id="check_login_value" /> --}}
                    <a href="#close" title="Close" class="button secondary login-cancel-btn">Cancel</a>
                    {!! Form::submit('Save', ['class' => 'save_login_rule']) !!}
                    {!! Form::close() !!} 
                </div>
            </article>
        </div>
    </div>
</div>