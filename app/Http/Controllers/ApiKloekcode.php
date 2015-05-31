<?php namespace App\Http\Controllers;

use App\Kloekecode;
use App\Http\Requests;
use App\Http\Requests\kloekecodeValidation;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Cloner\Cursor;

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
        if ($currentCursorStr = Request::input('cursor', false)) {
            $Kloekecode = Kloekecode::where('id', '>', $currentCursorStr)->take(5)->get();
        } else {
            $Kloekecode = Kloekecode::take(5)->get();
        }

        $prevCursorStr = Request::input('prevCursor', 6);
        $newCursorStr  = $Kloekecode->last()->id;
        $cursor        = new Cursor($currentCursorStr, $prevCursorStr, $newCursorStr, $Kloekecode->count());

        $resource = new Collection($Kloekecode, $this->KloekecodeCallback());
        $resource->setCursor($cursor);

        $response = response($this->fractal->createData($resource)->toJson());
        $response->header('application/json');

        return $response;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$response = response($content, $status);
        $response->header($mime);

        return $response;
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
        $response->header('Application/json');

        return $response;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$Api['Query']       = Kloekecode::where('id', '=', $id);
        $Api['Result']      = $Api['Query']->get();
        $Api['OutputArray'] = new Collection($Api['result'], $this->KloekecodeCallback());

        if (count($Api['Result']) > 0) {
            $content = $this->ErrorCallback();
        } else {
            $content = $this->fractal->createData($outputLayout)->toJson();
        }

        $response = response($content, 200);
        $response->header('Application/json');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$response = response($content, $status);
        $response->header($mime);

        return $response;
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
        $response->header('Application/json');
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
        $response->header('Application');

        return $response;
	}

}
