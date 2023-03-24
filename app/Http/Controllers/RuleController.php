<?php

namespace App\Http\Controllers;

use App\Models\CustomerTag;
use App\Models\Redirect;
use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RuleController extends Controller
{

    public function billingPlan(){

        $shop = Auth::user();
        $plan = "";
        if (isset($shop['plan_id']) && !empty($shop['plan_id'])) {
            return redirect()->route('settings', ['shop' => Auth::user()->name, 'host'=>app('request')->input('host')]);
        } else {
            return redirect()->route('billing.index', ['shop' => Auth::user()->name, 'host'=>app('request')->input('host')]);
        }
    }

    public function index()
    {
        $userId = Auth::user()->id;
        $loginData = Rule::orderBy('id', 'desc')->where('user_id', $userId)->where('rule_for', 'login')->with('customer_tags')->paginate(5);
        $logoutData = Rule::orderBy('id', 'desc')->where('user_id', $userId)->where('rule_for', 'logout')->with('customer_tags')->paginate(5);
        $registerData = Rule::orderBy('id', 'desc')->where('user_id', $userId)->where('rule_for', 'registration')->with('customer_tags')->paginate(5);
        return view('index', compact('loginData', 'logoutData', 'registerData'));
    }

    public function loginData(){
        $userId = Auth::user()->id;
        $loginData = Rule::orderBy('id', 'desc')->where('user_id', $userId)->where('rule_for', 'login')->with('customer_tags')->paginate(5);
        return view('form.login_rule', compact('loginData'));
    }

    public function logoutData(){
        $userId = Auth::user()->id;
        $logoutData = Rule::orderBy('id', 'desc')->where('user_id', $userId)->where('rule_for', 'logout')->with('customer_tags')->paginate(5);
        return view('form.logout_rule', compact('logoutData'));
    }

    public function registrationData() {
        $userId = Auth::user()->id;
        $registerData = Rule::orderBy('id', 'desc')->where('user_id', $userId)->where('rule_for', 'registration')->with('customer_tags')->paginate(5);
        return view('form.registration_rule', compact('registerData'));
    }

    public function getAllCustomersTags(Request $request)
    {
        $searchTitle = $request->get('term');
        if ($searchTitle == '') {
        }
        $fields = [
            'fields' => 'tags',
            'limit' => 249
        ];
        $shop = Auth::user();
        $result = $shop->api()->rest('GET', '/admin/api/2022-04/customers.json', $fields);
        $doubleTags=[];
        $singleTags=[];
        $dataArray=[];
        foreach ($result['body']['customers'] as $customer) {
            if ($customer['tags'] != '') {
                if (str_contains($customer['tags'], ',')) {
                    $doubleTags[] = str_replace(' ', '', explode(',', $customer['tags']));
                } else {
                    $singleTags[] = $customer['tags'];
                }
            }
        }
        $filtereddoubleTags=[];
        foreach ($doubleTags as $childArray)
        {
            foreach ($childArray as $value)
            {
                $filtereddoubleTags[] = $value;
            }
        }
        $finalArrays = array_unique(array_merge($filtereddoubleTags, $singleTags));
        $filtereFinalArray=[];
        foreach($finalArrays as $finalArray){
            $filtereFinalArray[] = $finalArray;
        }
        for ($i = 0; $i < count($filtereFinalArray); $i++) {
            $dataArray[] = [
                'id' => $filtereFinalArray[$i],
                'text' => $filtereFinalArray[$i]
            ];
        }
        return response()->json($dataArray);
    }

    public function getAllProducts(Request $request)
    {
        if ($request->get('type') == 'product') {
            $searchTitle = $request->get('term');
            $shop = Auth::user();
            $dataArray = [];
            if (isset($searchTitle)) {
                $products = $shop->api()->graph('
              {
                products(first:250, query:"title:*' . $searchTitle . '*") {
                  edges {
                    node {
                      id
                      title
                    }
                  }
                }
              }
            ')['body']['data']['products']['edges'];
            } else {
                $products = $shop->api()->graph('
              {
                products(first:250) {
                  edges {
                    node {
                      id
                      title
                    }
                  }
                }
              }
            ')['body']['data']['products']['edges'];
            }
            foreach ($products as $product) {
                array_push($dataArray, array("id" => basename(parse_url($product['node']['id'], PHP_URL_PATH)), "text" => $product['node']['title']));
            }
            return response()->json($dataArray);
        }
        if ($request->get('type') == 'collection') {
            $searchTitle = $request->get('term');
            $shop = Auth::user();
            $dataArray = [];
            if (isset($searchTitle)) {
                $collections = $shop->api()->graph('
                {
                    collections(first: 250, query:"title:*' . $searchTitle . '*") {
                        edges {
                            node {
                                id
                                title
                            }
                        }
                    }
                }
            ')['body']['data']['collections']['edges'];
            } else {
                $collections = $shop->api()->graph('
                    {
                        collections(first: 250) {
                            edges {
                                node {
                                    id
                                    title
                                }
                            }
                        }
                    }
                ')['body']['data']['collections']['edges'];
            }
            foreach ($collections as $collection) {
                array_push($dataArray, array("id" => basename(parse_url($collection['node']['id'], PHP_URL_PATH)), "text" => $collection['node']['title']));
            }
            return response()->json($dataArray);
        }
        if ($request->get('type') == 'page') {
            $searchTitle = $request->get('term');
            $dataArray = [];
            if (isset($searchTitle)) {

                $fields = [
                    'fields' => 'id,title',
                    'limit' => 250
                ];
                $shop = Auth::user();
                $result = $shop->api()->rest('GET', '/admin/api/2022-04/pages.json', $fields);
                foreach ($result['body']['pages'] as $product) {
                    if (stripos($product['title'], $searchTitle) !== false) {
                        $dataArray[] = (object)[
                            'text' => $product['title'],
                            'id' => $product['id']
                        ];
                    }
                }
                return response()->json($dataArray);
            } else {

                $fields = [
                    'fields' => 'id,title',
                    'limit' => 250
                ];
                $shop = Auth::user();
                $result = $shop->api()->rest('GET', '/admin/api/2022-04/pages.json', $fields);
                foreach ($result['body']['pages'] as $product) {

                    $dataArray[] = (object)[
                        'text' => $product['title'],
                        'id' => $product['id']
                    ];
                }
                return response()->json($dataArray);
            }
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'customer_category' => 'required_if:category,==,specific_tags',
                'redirect_value' => 'required_if:redirect_to,==,product,collection,page',
            ],
            [
                'redirect_value.required_if' => $request->redirect_to . ' field is required',
                'customer_category.required_if' => 'Customer tags field is required'
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $data = $request->except('_token');
            $data['user_id'] = Auth::user()->id;
            $dataa = Rule::create($data);
            $count = Rule::where('rule_for', $request->rule_for)->count();
            if ($request->customer_category) {
                $ruleId = $dataa->id;
                $redirect = new Redirect();
                if ($request->redirect_to == 'product') {
                    $redirect->product_id = $request->redirect_value;
                } else if ($request->redirect_to == 'collection') {
                    $redirect->collection_id = $request->redirect_value;
                } else if ($request->redirect_to == 'page') {
                    $redirect->page_id = $request->redirect_value;
                } 
                $redirect->rule_id = $ruleId;
                $redirect->save();
                for ($i = 0; $i < count($request->customer_category); $i++) {
                    $saveCustomer = new CustomerTag();
                    $saveCustomer->rule_id = $ruleId;
                    $saveCustomer->customer_tag = $request->customer_category[$i];
                    $saveCustomer->save();
                }
                return response()->json([
                    'status'  => 200,
                    'message' => 'Rule Added Successfully.',
                    'ctag'    => $saveCustomer,
                    'data'    => $dataa,
                    'ruleId'  => $ruleId,
                    'ruleFor' => $dataa->rule_for,
                    'count'   => $count
                ]);
            } else {
                $ruleId = $dataa->id;
                $redirect = new Redirect();
                if ($request->redirect_to == 'product') {
                    $redirect->product_id = $request->redirect_value;
                } else if ($request->redirect_to == 'collection') {
                    $redirect->collection_id = $request->redirect_value;
                } else if ($request->redirect_to == 'page') {
                    $redirect->page_id = $request->redirect_value;
                } 
                $redirect->rule_id = $ruleId;
                $redirect->save();
                return response()->json([
                    'status' => 200,
                    'message' => 'Rule Added Successfully.',
                    'data' => $dataa,
                    'ruleId' => $ruleId,
                    'count'   => $count
                ]);
            }
        }
    }

    public function edit($id)
    {
        $data = Rule::where('id', $id)->with(['customer_tags', 'redirect'])->first();
        $shop = Auth::user();
        $ruleId = $data->id;
        if ($data->redirect_to == 'product') {
            $productId =  $data['redirect']->product_id;
            $products = $shop->api()->graph('
              {
                product(id: "gid://shopify/Product/' . $productId . '") {
                    id
                    title
                }
              }
            ');
            $id = basename(parse_url($products['body']->data->product->id, PHP_URL_PATH));
            $collectionText = $products['body']->data->product->title;
            return response()->json([
                'data' => $data,
                'ruleId' => $ruleId,
                'id' => $id,
                'text' => $collectionText
            ]);
        } elseif ($data->redirect_to == 'collection') {
            $collectionId =  $data['redirect']->collection_id;
            $collections = $shop->api()->graph('
             {
                collection(id: "gid://shopify/Collection/' . $collectionId . '") {
                    id
                    title
                }
             }
            ');
            $id = basename(parse_url($collections['body']->data->collection->id, PHP_URL_PATH));
            $collectionText = $collections['body']->data->collection->title;
            return response()->json([
                'data' => $data,
                'ruleId' => $ruleId,
                'id' => $id,
                'text' => $collectionText
            ]);
        } elseif ($data->redirect_to == 'page') {
            $pageId =  $data['redirect']->page_id;
            $fields = [
                'fields' => 'id,title',
                'limit' => 250
            ];
            $page = $shop->api()->rest('GET', '/admin/api/2022-04/pages/' . $pageId . '.json', $fields);
            $id = $page['body']['page']->id;
            $pageText = $page['body']['page']->title;
            return response()->json([
                'data' => $data,
                'ruleId' => $ruleId,
                'id' => $id,
                'text' => $pageText
            ]);
        } 
             else {
                 return response()->json([
                'data' => $data,
                'ruleId' => $ruleId
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'customer_category' => 'required_if:category,==,specific_tags',
                'redirect_value' => 'required_if:redirect_to,==,product,collection,page',
            ],
            [
                'redirect_value.required_if' => $request->redirect_to . ' field is required',
                'customer_category.required_if' => 'Customer tags field is required'
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $dataa = Rule::find($id);
            $data = $request->except('_token');
            $data['user_id'] = Auth::user()->id;
            $dataa->fill($data)->save();
            if ($request->customer_category) {
                $ruleId = $dataa->id;
                $saveCustomer=[];
                CustomerTag::where('rule_id', $ruleId)->delete();
                for ($i = 0; $i < count($request->customer_category); $i++) {
                    $saveCustomer = new CustomerTag();
                    $saveCustomer->rule_id = $ruleId;
                    $saveCustomer->customer_tag = $request->customer_category[$i];
                    $saveCustomer->save();
                }
                Redirect::where('rule_id', $ruleId)->delete();
                $redirect = new Redirect();
                if ($request->redirect_to == 'product') {
                    $redirect->product_id = $request->redirect_value;
                } else if ($request->redirect_to == 'collection') {
                    $redirect->collection_id = $request->redirect_value;
                } else if ($request->redirect_to == 'page') {
                    $redirect->page_id = $request->redirect_value;
                } 
                $redirect->rule_id = $ruleId;
                $redirect->save();
                return response()->json([
                    'status' => 200,
                    'message' => 'Rule Updated Successfully.',
                    'ctag'    => $saveCustomer,
                    'data'    => $dataa,
                    'ruleId'  => $ruleId,
                    'ruleFor' => $dataa->rule_for
                ]);
            } else {
                $ruleId = $dataa->id;
                CustomerTag::where('rule_id', $ruleId)->delete();
                Redirect::where('rule_id', $ruleId)->delete();
                $redirect = new Redirect();
                if ($request->redirect_to == 'product') {
                    $redirect->product_id = $request->redirect_value;
                } else if ($request->redirect_to == 'collection') {
                    $redirect->collection_id = $request->redirect_value;
                } else if ($request->redirect_to == 'page') {
                    $redirect->page_id = $request->redirect_value;
                }
                $redirect->rule_id = $ruleId;
                $redirect->save();
                return response()->json([
                    'status' => 200,
                    'message' => 'Rule Updated Successfully.',
                    'data' => $dataa,
                    'ruleId' => $ruleId,
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $rule = Rule::find($id);
        if ($rule) {
            $rule->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Rule Deleted Successfully.',
                'id' => $rule->id,
                'ruleFor' => $rule->rule_for
            ]);
        }
    }

    public function pagination(Request $request)
    {
        $userId = Auth::user()->id;
        $search = $request->search;
        $loginSearch = $request->loginSearch;
        $logoutSearch = $request->logoutSearch;
        $registrationSearch = $request->registrationSearch;
            if($search !=""){
            if ($request->activeTab == 'login') {
                $data=Rule::
                orWhere([
                    ['redirect_to', 'LIKE', "%{$search}%"],
                    ['user_id', '=', "{$userId}"],
                    ['rule_for', '=', "login"],
                ])->
                orWhere([
                    ['category', 'LIKE', "%{$search}%"],
                    ['user_id', '=', "{$userId}"],
                    ['rule_for', '=', "login"], 
                ])->
                with(['customer_tags'])->
                orWhereHas('customer_tags', function($query) use ($search){
                    $query->where('customer_tag','like','%' .$search.'%');
                })
                ->where('rule_for', '=', "login")
                ->where('user_id',$userId)
                ->paginate(5);
                
                $pagination = $data->render('pagination.pagination');
                return response()->json([
                    'status' => 200,
                    'data' => $data,
                    'pagination' => "$pagination",
                    'searchPaginationData' => "search-data-login",
                    'paginationBtn' => "login-pagination"
                ]);
            } else if ($request->activeTab == 'logout') {
                $data=Rule::
                orWhere([
                    ['redirect_to', 'LIKE', "%{$search}%"],
                    ['user_id', '=', "{$userId}"],
                    ['rule_for', '=', "logout"],
                ])->
                orWhere([
                    ['category', 'LIKE', "%{$search}%"],
                    ['user_id', '=', "{$userId}"],
                    ['rule_for', '=', "logout"], 
                ])->with(['customer_tags'])->
                orWhereHas('customer_tags', function($query) use ($search){
                    $query->where('customer_tag','like','%' .$search.'%');
                })
                ->where('rule_for', '=', "logout")
                ->where('user_id',$userId)
                ->paginate(5);
                $pagination = $data->render('pagination.logout-pagination');
                return response()->json([
                    'status' => 200,
                    'data' => $data,
                    'pagination' => "$pagination",
                    'searchPaginationData' => "search-data-logout",
                    'paginationBtn' => "logout-pagination"
                ]);
            } else {
                $data=Rule::
                orWhere([
                    ['redirect_to', 'LIKE', "%{$search}%"],
                    ['user_id', '=', "{$userId}"],
                    ['rule_for', '=', "registration"],
                ])->
                orWhere([
                    ['category', 'LIKE', "%{$search}%"],
                    ['user_id', '=', "{$userId}"],
                    ['rule_for', '=', "registration"], 
                ])->with(['customer_tags'])->
                orWhereHas('customer_tags', function($query) use ($search){
                    $query->where('customer_tag','like','%' .$search.'%');
                })
                ->where('rule_for', '=', "registration")
                ->where('user_id',$userId)
                ->paginate(5);
                $pagination = $data->render('pagination.registration-pagination');
                return response()->json([
                    'status' => 200,
                    'data' => $data,
                    'pagination' => "$pagination",
                    'searchPaginationData' => "search-data-registration",
                    'paginationBtn' => "registration-pagination"
                ]);
            }
        } else {
            if ($request->activeTab == 'login') {
                $data=Rule::
                orWhere([
                    ['redirect_to', 'LIKE', "%{$loginSearch}%"],
                    ['user_id', '=', "{$userId}"],
                    ['rule_for', '=', "login"],
                ])->
                orWhere([
                    ['category', 'LIKE', "%{$loginSearch}%"],
                    ['user_id', '=', "{$userId}"],
                    ['rule_for', '=', "login"], 
                ])->with(['customer_tags'])->
                orWhereHas('customer_tags', function($query) use ($loginSearch){
                    $query->where('customer_tag','like','%' .$loginSearch.'%');
                })
                ->where('rule_for', '=', "login")
                ->where('user_id',$userId)->orderBy('id', 'desc')
                ->paginate(5);
                $pagination = $data->render('pagination.pagination');
                return response()->json([
                    'status' => 200,
                    'data' => $data,
                    'pagination' => "$pagination",
                    'searchPaginationData' => "search-data-login",
                    'paginationBtn' => "login-pagination"
                ]);
            } else if ($request->activeTab == 'logout') {
                $data=Rule::
                orWhere([
                    ['redirect_to', 'LIKE', "%{$logoutSearch}%"],
                    ['user_id', '=', "{$userId}"],
                    ['rule_for', '=', "logout"],
                ])->
                orWhere([
                    ['category', 'LIKE', "%{$logoutSearch}%"],
                    ['user_id', '=', "{$userId}"],
                    ['rule_for', '=', "logout"], 
                ])->with(['customer_tags'])->
                orWhereHas('customer_tags', function($query) use ($logoutSearch){
                    $query->where('customer_tag','like','%' .$logoutSearch.'%');
                })
                ->where('rule_for', '=', "logout")
                ->where('user_id',$userId)->orderBy('id', 'desc')
                ->paginate(5);
                $pagination = $data->render('pagination.logout-pagination');
                return response()->json([
                    'status' => 200,
                    'data' => $data,
                    'pagination' => "$pagination",
                    'searchPaginationData' => "search-data-logout",
                    'paginationBtn' => "logout-pagination"
                ]);
            } else if ($request->activeTab == 'registration') {
                $data=Rule::
                orWhere([
                    ['redirect_to', 'LIKE', "%{$registrationSearch}%"],
                    ['user_id', '=', "{$userId}"],
                    ['rule_for', '=', "registration"],
                ])->
                orWhere([
                    ['category', 'LIKE', "%{$registrationSearch}%"],
                    ['user_id', '=', "{$userId}"],
                    ['rule_for', '=', "registration"], 
                ])->with(['customer_tags'])->
                orWhereHas('customer_tags', function($query) use ($registrationSearch){
                    $query->where('customer_tag','like','%' .$registrationSearch.'%');
                })
                ->where('rule_for', '=', "registration")
                ->where('user_id',$userId)->orderBy('id', 'desc')
                ->paginate(5);
                $pagination = $data->render('pagination.registration-pagination');
                return response()->json([
                    'status' => 200,
                    'data' => $data,
                    'pagination' => "$pagination",
                    'searchPaginationData' => "search-data-registration",
                    'paginationBtn' => "registration-pagination"
                ]);
            }
        }
    }
}
