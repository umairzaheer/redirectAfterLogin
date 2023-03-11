<div id ="load-logout-data">

@if (count($logoutData) > 0)
<section class="full-width">
    <article>
        <div class="column twelve">
            <div class="has-sections">
                <div class="columns twelve">
                    <div class="align-center">
                        @if (count($logoutData) > 0)
                            <input type="search" placeholder="Search" id="logout-search">
                        @endif
                    </div>
                </div>
            </div>
                <div class="row"></div>
                <div class="has-sections">
                    <div class="columns twelve">
                    <div class="overflow-container">
                        <table id = "logout-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Applied on</th>
                                    <th>Customer Tags</th>
                                    <th>Redirect to</th>
                                    <th>Priority</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="search-data-logout">
                                @foreach ($logoutData as $record)
                                    <tr id="{{ $record['id'] }}">
                                        <input type="hidden" id="{{ $record['id'] }}">
                                        <td><span class="highlight-warning">{{ $record->id }}</span></td>
                                        @if ($record['category'] == 'all_customers')
                                        <td>All Customers</td>
                                        @elseif($record['category'] == 'specific_tags')
                                        <td>Specific Tags</td>
                                        @endif
                                        <td>
                                            @foreach ($record['customer_tags'] as $tags)
                                            <span class = "tag grey">{{$tags->customer_tag}}</span>
                                            @endforeach
                                        </td>
                                        @if ($record['redirect_to'] == 'last_page')
                                        <td>Last Page</td>
                                    @elseif($record['redirect_to'] == 'default')
                                        <td>Default</td>
                                    @elseif($record['redirect_to'] == 'home')
                                        <td>Home</td>
                                    @elseif($record['redirect_to'] == 'product')
                                        <td>Product</td>
                                    @elseif($record['redirect_to'] == 'collection')
                                    <td>Collection</td>
                                    @elseif($record['redirect_to'] == 'page')
                                    <td>Page</td>
                                    @endif
                                        <td>{{ $record['priority'] }}</td>
                                        <td>
                                        <a href="edit-login/{{ $record['id'] }}"><button value="{{ $record['id'] }}"
                                                class="secondary icon-edit edit-rule" data-id = "{{ $record['id'] }}"></button></a>
                                        <button value="{{ $record['id'] }}" class="secondary icon-trash"
                                            id="delete-rule"></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </article>
        </section>
        @else 
 <span class ="no-record-hide-logout" style="color:red;"><h6>No record available</h6></span>
 @endif

    <div id="logout-pagination"  class = "columns twelve" style = "display: flex; justify-content:center; margin-bottom:15px;">
        {!! $logoutData->links('pagination.logout-pagination') !!}
    </div>
</div>