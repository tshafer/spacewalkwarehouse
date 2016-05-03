<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use App\Coupon;
use App\Event;
use App\Http\Controllers\Controller;
use Exception;


class CouponsController extends Controller
{

    protected $stripe;

    /**
     * @var array
     */
    protected $rules = [
      'event_id'           => 'exists:events,id',
      'code'               => 'required|max:255|unique:coupons,code',
      'amount_off'         => 'regex:/^\d*(\.\d{2})?$/|required_without:percent_off',
      'redeem_by'          => 'required|date_format:m/d/Y g:i A|after:now',
      'max_redemptions'    => 'integer',
      'percent_off'        => 'integer|required_without:amount_off',
    ];


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $coupons = $coupon = new Coupon;

        if ($column = Input::get('sort_by')) {
            $coupons = $coupons->orderBy($column, Input::get('dir', 'asc'));
        }

        $coupons = $coupons->paginate();

        return view('admin.coupons.index', compact('coupon', 'coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $events = Event::get()->lists('name', 'id');

        return view('admin.coupons.create', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {

        $this->validate($request, $this->rules);

        try {
            $coupon = Coupon::create($request->all());

            $event = Event::find($request->get('event_id'));

            $coupon->event()->associate($event);
        } catch (\Exception $e) {
            flash($e->getMessage());

            return redirect()->route('admin.coupons.create')->withInput();
        }

        return redirect()->route('admin.coupons.show', [$coupon->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Coupon $coupon
     *
     * @return Response
     */
    public function show(Coupon $coupon)
    {
        return view('admin.coupons.show', compact('coupon'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Coupon $coupon
     *
     * @return Response
     */

    public function destroy(Coupon $coupon)
    {
        try {

            $coupon->delete();
        } catch (\Exception $e) {

            flash($e->getMessage());

            return redirect()->route('admin.coupons.index');
        }

        flash('Coupon Deleted Successfully');

        return redirect()->route('admin.coupons.index');
    }


}
