<?php namespace App\Http\Controllers;

use App\Kloekecode;
use App\Http\Requests;
use App\Http\Requests\kloekecodeValidation;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\Cursor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ApiKloekcode extends ApiController {

    private $fractal;
    private $AdminMiddleware = ['edit','delete','create','insert'];

    /**
     * Class constructor
     */
    function __construct()
    {
        $this->middleware('Admin', ['only' => $this->AdminMiddleware]);
        $this->fractal = new Manager();
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        if ($currentCursorStr = Input::get('cursor', false)) {
            $Kloekecode = Kloekecode::where('id', '>', $currentCursorStr)->take(5)->get();
        } else {
            $Kloekecode = Kloekecode::take(5)->get();
        }

        $prevCursorStr = Input::get('prevCursor', 6);
        $newCursorStr  = $Kloekecode->last()->id;
        $cursor        = new Cursor($currentCursorStr, $prevCursorStr, $newCursorStr, $Kloekecode->count());

        $resource = new Collection($Kloekecode, $this->KloekecodeCallback());
        $resource->setCursor($cursor);

        $response = response($this->fractal->createData($resource)->toJson());
        $response->header('Content-Type', 'application/json');

        return $response;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// No logic needed
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param kloekecodeValidation $input
     * @return Response
     */
	public function store(kloekecodeValidation $input)
	{
		$MySQL             = new Kloekecode;
        $MySQL->Kloekecode = $input->kloekecode;
        $MySQL->plaats     = $input->plaats;
        $MySQL->gemeente   = $input->gemeente;
        $MySQL->provincie  = $input->provincie;
        $MySQL->save();

        if ($MySQL->count() == 0 ) {
            // Success message
            $content = ['message' => ''];
        } else {
            // Error content
            $content = ['message' => ''];
        }

        $response = response($content, 200);
        $response->header('Content-Type', 'Application/json');

        return $response;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($kloekecode)
	{
		$Query       = Kloekecode::where('id', '=', $kloekecode)->get();
        $OutputArray = new Collection($Query, $this->KloekecodeCallback());

        if (count($Query) > 0) {
            $content = $this->fractal->createData($OutputArray)->toJson();
        } else {
            $content = $this->ErrorCallback();
        }

        $response = response($content, 200);
        $response->header('Content-Type', 'Application/json');

        return $response;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// No logic needed
	}

    /**
     * Update the specified resource in storage.
     *
     * @param kloekecodeValidation $input
     * @param  int $id
     * @return Response
     */
	public function update(kloekecodeValidation $input, $id)
	{
        $MySQL = Kloekecode::find($id);
        $MySQL->Kloekecode = $input->kloekecode;
        $MySQL->plaats     = $input->plaats;
        $MySQL->gemeente   = $input->gemeente;
        $MySQL->provincie  = $input->provincie;
        $MySQL->save();

        if ($MySQL->count() > 0) {
            $content = ['message' => 'Updated the resource successfully'];
        } else {
            $content = $this->ErrorCallback();
        }

        $response = response($content, 200);
        $response->header('Content-Type', 'Application/json');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$MySQL = Kloekecode::find($id);
        $MySQL->delete();

        if ($MySQL->count == 0) {
            // Success message
            $content = ['message' => 'Kloekecode successfully deleted'];
        } else {
            // Error message
            $content = $this->ErrorCallback();
        }

        $response = response($content, 200);
        $response->header('Content-Type', 'Application/json');

        return $response;
	}

}
