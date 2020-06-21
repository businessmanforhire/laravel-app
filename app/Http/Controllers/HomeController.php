<?php

namespace App\Http\Controllers;

use App\Banner;
use App\BusinessCategory;
use App\BusinessInfo;
use App\Category;
use App\MobileUser;
use App\Order;
use App\Product;
use App\Review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Charts\UserChart;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Charts\SampleChart;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $system_users=User::where('role','!=',User::business)->count();
        $mobile_users=MobileUser::count();
        $business=BusinessInfo::count();
        $products=Product::count();
        $business_categories=BusinessCategory::count();
        $categories=Category::count();
        $users = MobileUser::select(\DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(\DB::raw("Month(created_at)"))
            ->pluck('count');
        $latest_reviews=Review::orderby('created_at','desc')->take(7)->get();
        $banners=Banner::where('visible',Banner::visible)->count();
        $business_reviewa=Review::count();


        $chart = new UserChart;
        $chart->labels(['Jan', 'Feb', 'Mar', 'April', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
        $chart->dataset('New User Register Chart', 'line', $users)
              ->options(['fill' => 'true', 'borderColor' => '#51C1C0']);


        //SALES CHART
        $today_sales = Order::whereDate('created_at', today())->where('status','approved')->count();
        $yesterday_sales = Order::whereDate('created_at', today()->subDays(1))->where('status','approved')->count();
        $sales_2_days_ago = Order::whereDate('created_at', today()->subDays(2))->where('status','approved')->count();
        $chart2 = new SampleChart;
        $chart2->labels(['2 days ago', 'Yesterday', 'Today']);
        $chart2->dataset('Approved Orders', 'line', [$sales_2_days_ago, $yesterday_sales, $today_sales])
            ->options(['fill' => 'true', 'borderColor' => '#51C1C0']);

        $pending_orders=Order::pending()->whereDate('created_at', Carbon::today())->count();
        $refused_orders=Order::refused()->whereDate('created_at', Carbon::today())->count();
        $delivering_orders=Order::delivering()->whereDate('created_at', Carbon::today())->count();
        $approved_orders=Order::delivering()->whereMonth('created_at', Carbon::now()->month)->count();
        $borderColors = ["rgb(255, 201, 61)", "rgb(255, 163, 103)",];
        $fillColors = ["rgb(255, 201, 61)", "rgb(255, 163, 103)",];

        //MOBILE USER CHART
        $ios=MobileUser::where('platform','ios')->count();
        $android=MobileUser::where('platform','android')->count();
        $usersChart = new UserChart;
        $usersChart->minimalist(true);
        $usersChart->labels(['iOS', 'Android']);
        $usersChart->dataset('Users by trimester', 'doughnut', [$ios, $android])
            ->color($borderColors)
            ->backgroundcolor($fillColors);

        //AGE CHART
        $count_under_25 = DB::select( DB::raw("SELECT count(*) as 'total' FROM `mobile_users` WHERE date_of_birth BETWEEN CURDATE() - INTERVAL 25 YEAR AND CURDATE() - INTERVAL 18 YEAR ") );
        $count_under_45 = DB::select( DB::raw("SELECT count(*) as 'total' FROM `mobile_users` WHERE date_of_birth BETWEEN CURDATE() - INTERVAL 45 YEAR AND CURDATE() - INTERVAL 26 YEAR ") );
        $count_above_46 = DB::select( DB::raw("SELECT count(*) as 'total' FROM `mobile_users` WHERE date_of_birth BETWEEN CURDATE() - INTERVAL 70 YEAR AND CURDATE() - INTERVAL 46 YEAR ") );
        $borderColors = [
            "rgb(255, 201, 61)",
            "rgb(255, 163, 103)",
            "rgb(116, 123, 234)",
        ];
        $fillColors = [
            "rgb(255, 201, 61)",
            "rgb(255, 163, 103)",
            "rgb(116, 123, 234)",
        ];
        $ageChart = new UserChart;
        $ageChart->minimalist(true);
        $ageChart->labels(['18-25', '26-45','>45']);
        $ageChart->dataset('Users by age', 'doughnut', [$count_under_25[0]->total, $count_under_45[0]->total,$count_above_46[0]->total])
            ->color($borderColors)
            ->backgroundcolor($fillColors);


        $data = array(
            'system_users'                => $system_users,
            'mobile_users'                => $mobile_users,
            'latest_reviews'              => $latest_reviews,
            'business'                    => $business,
            'products'                    => $products,
            'business_categories'         => $business_categories,
            'categories'                  => $categories,
            'chart'                       => $chart,
            'chart2'                      => $chart2,
            'pending_orders'              => $pending_orders,
            'refused_orders'              => $refused_orders,
            'delivering_orders'           => $delivering_orders,
            'usersChart'                  => $usersChart,
            'approved_orders'             => $approved_orders,
            'ageChart'                    => $ageChart,
            'banners'                     => $banners,
            'business_reviewa'            => $business_reviewa,
        );
        return view('home',$data);
    }

    public function dashboard()
    {

        $user_id=Auth::id();
        $products=Product::where('business_id',Auth::id())->count();
        $approved_orders=Order::approved()->where('business_id',Auth::id())->count();
        $refused_orders=Order::refused()->where('business_id',Auth::id())->count();
        $pending_orders=Order::refused()->where('business_id',Auth::id())->count();

        $today_sales = Order::whereDate('created_at', today())->where('status','approved')->where('business_id',Auth::id())->count();
        $yesterday_sales = Order::whereDate('created_at', today()->subDays(1))->where('status','approved')->where('business_id',Auth::id())->count();
        $sales_2_days_ago = Order::whereDate('created_at', today()->subDays(2))->where('status','approved')->where('business_id',Auth::id())->count();

        $chart_orders = new SampleChart;
        $chart_orders->labels(['2 days ago', 'Yesterday', 'Today']);
        $chart_orders->dataset('Approved Orders', 'line', [$sales_2_days_ago, $yesterday_sales, $today_sales])
            ->options([
                'fill' => 'true',
                'borderColor' => '#51C1C0'
            ]);

        $most_sold_product_week=DB::select( DB::raw("SELECT product_id, SUM(quantity) AS total from order_items as oi inner join orders as o  on o.id=oi.order_id  WHERE YEARWEEK(o.created_at)=YEARWEEK(NOW()) and o.business_id=$user_id GROUP BY  product_id order by total desc  limit 5"));


        $data = array(
            'products'             => $products,
            'approved_orders'             => $approved_orders,
            'refused_orders'             => $refused_orders,
            'pending_orders'             => $pending_orders,
            'chart_orders'             => $chart_orders,
            'most_sold_product_week'             => $most_sold_product_week,
        );
        return view('business_dashboard',$data);
    }
    public function orders_notification(){

        $orders = Order::where('status' , 'pending')
            ->where('business_id',Auth::id())
            ->orderBy('id', 'desc')
            ->take(7)
            ->get();
        return view("notifications.orders_notification")->with("orders", $orders);
    }

    public function update_notification_counter()
    {
        $orders =  Order::where('status' , 'pending')->where('business_id',Auth::id())->count();
        return $orders;
    }

    public function review_notification(){

        $review = Review::where('state' , Review::unseen)->where('business_id',Auth::id())->get();
        return view("notifications.review_notification")->with("review", $review);
    }

    public function review_notification_counter()
    {
        $review = Review::where('state' , Review::unseen)->where('business_id',Auth::id())->count();
        return $review;
    }
}
