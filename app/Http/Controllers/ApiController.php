<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use Illuminate\Http\Request;
use App\Models\User;

class ApiController extends Controller
{
    public function getLoginData(Request $request)
    {
        $domain = $request->shop;
        $shop = User::where('name', $domain)->first();
        $userId = $shop->id;
        $data = '';
        $customer = $shop->api()->rest('GET', '/admin/customers/search.json', ["fields" => "id, email,tags", "query" => "email:$request->email"]);
        if (count($customer['body']['customers']) > 0) {
            $customerTags = $customer['body']['customers']['0']['tags'];
            $customerTags = explode(', ', $customerTags);
            $data = Rule::Where('rule_for', 'login')->where('user_id', $userId)->orderBy('priority', 'asc')->with(['customer_tags', 'redirect'])->orderBy('id', 'desc')->first();
            if ($data != null) {
                if ($data->category == "specific_tags") {
                    $url='';
                    $ctags = [];
                    foreach ($data['customer_tags'] as $ctag) {
                        $ctags[] .= $ctag['customer_tag'];
                    }
                    if ($customerTags) {
                        $compareTags = array_intersect($customerTags, $ctags);
                        if ($compareTags != []) {
                            if ($data['redirect_to'] == 'collection') {
                                $collectionId =  $data['redirect']['collection_id'];
                                $collections = $shop->api()->graph('
                            {
                               collection(id: "gid://shopify/Collection/' . $collectionId . '") {
                                   id
                                   title
                                   handle
                               }
                            }
                           ');
                                $collectionHandle = $collections['body']['data']['collection']->handle;
                                $url = '/collections/' . $collectionHandle;
                                return response()->json([
                                    'redirect_url' => $url,
                                    'msg' => true,
                                    'default' => false,
                                ]);
                            } else if ($data['redirect_to'] == 'product') {
                                $productId = $data['redirect']['product_id'];
                                $products = $shop->api()->graph('
                            {
                                product(id: "gid://shopify/Product/' . $productId . '") {
                                    id
                                    title
                                    handle
                                }
                            }
                            ');
                                $productHandle = $products['body']['data']['product']->handle;
                                $url = '/products/' . $productHandle;
                                return response()->json([
                                    'redirect_url' => $url,
                                    'msg' => true,
                                    'default' => false,
                                ]);
                            } else if ($data['redirect_to'] == 'page') {
                                $pageId = $data['redirect']['page_id'];
                                $page = $shop->api()->rest('GET', '/admin/api/2022-04/pages/' . $pageId . '.json');
                                $Pagehandle = $page['body']['page']->handle;
                                $url = '/pages/' . $Pagehandle;
                                return response()->json([
                                    'redirect_url' => $url,
                                    'msg' => true,
                                    'default' => false,
                                ]);
                            } else if ($data['redirect_to'] == 'home') {
                                $url = '/';
                                return response()->json([
                                    'redirect_url' => $url,
                                    'msg' => true,
                                    'default' => false,
                                ]);
                            } else if ($data['redirect_to'] == 'last_page') {
                                $url = '';
                                return response()->json([
                                    'redirect_url' => $url,
                                    'msg' => true,
                                    'default' => false,
                                    'last_page' => true,
                                ]);
                            } else {
                                return response()->json([
                                    'msg' => true,
                                    'default' => true,
                                ]);
                            }
                        } else {
                            return response()->json([
                                'msg' => true,
                                'default' => true,
                            ]);
                        }
                    }
                }
                if ($data->category == "all_customers") {
                    $url = '';
                    if ($data['redirect_to'] == 'collection') {
                        $collectionId =  $data['redirect']['collection_id'];
                        $collections = $shop->api()->graph('
                    {
                       collection(id: "gid://shopify/Collection/' . $collectionId . '") {
                           id
                           title
                           handle
                       }
                    }
                   ');
                        $collectionHandle = $collections['body']['data']['collection']->handle;
                        $url = '/collections/' . $collectionHandle;
                        return response()->json([
                            'redirect_url' => $url,
                            'msg' => true,
                            'default' => false,
                        ]);
                    } else if ($data['redirect_to'] == 'product') {
                        $productId = $data['redirect']['product_id'];
                        $products = $shop->api()->graph('
                    {
                        product(id: "gid://shopify/Product/' . $productId . '") {
                            id
                            title
                            handle
                        }
                    }
                    ');
                        $productHandle = $products['body']['data']['product']->handle;
                        $url = '/products/' . $productHandle;
                        return response()->json([
                            'redirect_url' => $url,
                            'msg' => true,
                            'default' => false,
                        ]);
                    } else if ($data['redirect_to'] == 'page') {
                        $pageId = $data['redirect']['page_id'];
                        $page = $shop->api()->rest('GET', '/admin/api/2022-04/pages/' . $pageId . '.json');
                        $Pagehandle = $page['body']['page']->handle;
                        $url = '/pages/' . $Pagehandle;
                        return response()->json([
                            'redirect_url' => $url,
                            'msg' => true,
                            'default' => false,
                        ]);
                    } else if ($data['redirect_to'] == 'home') {
                        $url = '/';
                        return response()->json([
                            'redirect_url' => $url,
                            'msg' => true,
                            'default' => false,
                        ]);
                    } else if ($data['redirect_to'] == 'last_page') {
                        $url = '';
                        return response()->json([
                            'redirect_url' => $url,
                            'msg' => true,
                            'default' => false,
                            'last_page' => true,
                        ]);
                    } else {
                        return response()->json([
                            'msg' => true,
                            'default' => true,
                        ]);
                    }
                }
            } else {
                return response()->json([
                    'msg' => false,
                ]);
            }
        } else {
            return response()->json([
                'msg' => false,
            ]);
        }
    }

    public function getLogoutData(Request $request)
    {
        $domain = $request->shop;
        $cid = $request->cid;
        $shop = User::where('name', $domain)->first();
        $userId = $shop->id;
        $data = '';
        $customer = $shop->api()->rest('GET', '/admin/customers/' . $cid . '.json');
        if (count($customer['body']['customer']) > 0) {
            $customerTags = $customer['body']['customer']['tags'];
            $customerTags = explode(', ', $customerTags);
            $data = Rule::Where('rule_for', 'logout')->where('user_id', $userId)->orderBy('priority', 'asc')->with(['customer_tags', 'redirect'])->orderBy('id', 'desc')->first();
            if ($data != null) {
                if ($data->category == "specific_tags") {
                    $url='';
                    $ctags = [];
                    foreach ($data['customer_tags'] as $ctag) {
                        $ctags[] .= $ctag['customer_tag'];
                    }
                    if ($customerTags) {
                        $compareTags = array_intersect($customerTags, $ctags);
                        if ($compareTags != []) {
                            if ($data['redirect_to'] == 'collection') {
                                $collectionId =  $data['redirect']['collection_id'];
                                $collections = $shop->api()->graph('
                            {
                               collection(id: "gid://shopify/Collection/' . $collectionId . '") {
                                   id
                                   title
                                   handle
                               }
                            }
                           ');
                                $collectionHandle = $collections['body']['data']['collection']->handle;
                                $url = '/collections/' . $collectionHandle;
                                return response()->json([
                                    'redirect_url' => $url,
                                    'msg' => true,
                                    'default' => false,
                                ]);
                            } else if ($data['redirect_to'] == 'product') {
                                $productId = $data['redirect']['product_id'];
                                $products = $shop->api()->graph('
                            {
                                product(id: "gid://shopify/Product/' . $productId . '") {
                                    id
                                    title
                                    handle
                                }
                            }
                            ');
                                $productHandle = $products['body']['data']['product']->handle;
                                $url = '/products/' . $productHandle;
                                return response()->json([
                                    'redirect_url' => $url,
                                    'msg' => true,
                                    'default' => false,
                                ]);
                            } else if ($data['redirect_to'] == 'page') {
                                $pageId = $data['redirect']['page_id'];
                                $page = $shop->api()->rest('GET', '/admin/api/2022-04/pages/' . $pageId . '.json');
                                $Pagehandle = $page['body']['page']->handle;
                                $url = '/pages/' . $Pagehandle;
                                return response()->json([
                                    'redirect_url' => $url,
                                    'msg' => true,
                                    'default' => false,
                                ]);
                            } else if ($data['redirect_to'] == 'home') {
                                $url = '/';
                                return response()->json([
                                    'redirect_url' => $url,
                                    'msg' => true,
                                    'default' => false,
                                ]);
                            } else if ($data['redirect_to'] == 'last_page') {
                                $url = '';
                                return response()->json([
                                    'redirect_url' => $url,
                                    'msg' => true,
                                    'default' => false,
                                    'last_page' => true,
                                ]);
                            } else {
                                return response()->json([
                                    'msg' => true,
                                    'default' => true,
                                ]);
                            }
                        } else {
                            return response()->json([
                                'msg' => true,
                                'default' => true,
                            ]);
                        }
                    }
                }
                if ($data->category == "all_customers") {
                    $url;
                    if ($data['redirect_to'] == 'collection') {
                        $collectionId =  $data['redirect']['collection_id'];
                        $collections = $shop->api()->graph('
                    {
                       collection(id: "gid://shopify/Collection/' . $collectionId . '") {
                           id
                           title
                           handle
                       }
                    }
                   ');
                        $collectionHandle = $collections['body']['data']['collection']->handle;
                        $url = '/collections/' . $collectionHandle;
                        return response()->json([
                            'redirect_url' => $url,
                            'msg' => true,
                            'default' => false,
                        ]);
                    } else if ($data['redirect_to'] == 'product') {
                        $productId = $data['redirect']['product_id'];
                        $products = $shop->api()->graph('
                    {
                        product(id: "gid://shopify/Product/' . $productId . '") {
                            id
                            title
                            handle
                        }
                    }
                    ');
                        $productHandle = $products['body']['data']['product']->handle;
                        $url = '/products/' . $productHandle;
                        return response()->json([
                            'redirect_url' => $url,
                            'msg' => true,
                            'default' => false,
                        ]);
                    } else if ($data['redirect_to'] == 'page') {
                        $pageId = $data['redirect']['page_id'];
                        $page = $shop->api()->rest('GET', '/admin/api/2022-04/pages/' . $pageId . '.json');
                        $Pagehandle = $page['body']['page']->handle;
                        $url = '/pages/' . $Pagehandle;
                        return response()->json([
                            'redirect_url' => $url,
                            'msg' => true,
                            'default' => false,
                        ]);
                    } else if ($data['redirect_to'] == 'home') {
                        $url = '/';
                        return response()->json([
                            'redirect_url' => $url,
                            'msg' => true,
                            'default' => false,
                        ]);
                    } else if ($data['redirect_to'] == 'last_page') {
                        $url = '';
                        return response()->json([
                            'redirect_url' => $url,
                            'msg' => true,
                            'default' => false,
                            'last_page' => true,
                        ]);
                    } else {
                        return response()->json([
                            'msg' => true,
                            'default' => true,
                        ]);
                    }
                }
            } else {
                return response()->json([
                    'msg' => false,
                ]);
            }
        } else {
            return response()->json([
                'msg' => false,
            ]);
        }
    }

    public function getRegistrationData(Request $request)
    {
        $domain = $request->shop;
        $shop = User::where('name', $domain)->first();
        $userId = $shop->id;
        $data = Rule::Where('rule_for', 'registration')->where('user_id', $userId)->orderBy('priority', 'asc')->with('redirect')->orderBy('id', 'desc')->first();
        if ($data != null) {
            if ($data->category == "all_customers") {
                $url = '';
                if ($data['redirect_to'] == 'collection') {
                    $collectionId =  $data['redirect']['collection_id'];
                    $collections = $shop->api()->graph('
                {
                   collection(id: "gid://shopify/Collection/' . $collectionId . '") {
                       id
                       title
                       handle
                   }
                }
               ');
                    $collectionHandle = $collections['body']['data']['collection']->handle;
                    $url = '/collections/' . $collectionHandle;
                    return response()->json([
                        'redirect_url' => $url,
                        'msg' => true,
                        'default' => false,
                    ]);
                } else if ($data['redirect_to'] == 'product') {
                    $productId = $data['redirect']['product_id'];
                    $products = $shop->api()->graph('
                {
                    product(id: "gid://shopify/Product/' . $productId . '") {
                        id
                        title
                        handle
                    }
                }
                ');
                    // return $products;
                    $productHandle = $products['body']['data']['product']->handle;
                    $url = '/products/' . $productHandle;
                    return response()->json([
                        'redirect_url' => $url,
                        'msg' => true,
                        'default' => false,
                    ]);
                } else if ($data['redirect_to'] == 'page') {
                    $pageId = $data['redirect']['page_id'];
                    $page = $shop->api()->rest('GET', '/admin/api/2022-04/pages/' . $pageId . '.json');
                    $Pagehandle = $page['body']['page']->handle;
                    $url = '/pages/' . $Pagehandle;
                    return response()->json([
                        'redirect_url' => $url,
                        'msg' => true,
                        'default' => false,
                    ]);
                } else if ($data['redirect_to'] == 'home') {
                    $url = '/';
                    return response()->json([
                        'redirect_url' => $url,
                        'msg' => true,
                        'default' => false,
                    ]);
                } else if ($data['redirect_to'] == 'last_page') {
                    $url = '';
                    return response()->json([
                        'redirect_url' => $url,
                        'msg' => true,
                        'default' => false,
                        'last_page' => true,
                    ]);
                } else {
                    return response()->json([
                        'msg' => true,
                        'default' => true,
                    ]);
                }
            }
        }
        else {
            return response()->json([
                'msg' => false,
            ]);
        }
    }
}
