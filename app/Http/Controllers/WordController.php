<?php

namespace App\Http\Controllers;

use App\Words;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WordController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @link   GET
	 * @return Response
	 */
	public function index() {
		$data['title']  = Lang::get('');
		$data['active'] = 2;
		$data['qeury']  = Words::with()->paginate(25);

		return view('client.words
		', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @link   GET
	 * @return Response
	 */
	public function create() {
		$data['title']  = Lang::get('');
		$data['active'] = 2;

		return view('', $data)
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @link   POST
	 * @return Response
	 */
	public function store(WordValidation $request) {
		$word               = new Words;
		$word->user_id      = Auth::user()->id;
		$word->region_id    = $request->regionID;
		$word->word         = $request->word;
		$word->word_an      = $request->word_an;
		$word->word_fonetic = $request->word_fonetic;
		$word->dialect      = $request->dialect;
		$word->description  = $request->description;
		$word->save();

		$alert['class']   = Lang::get('');
		$alert['heading'] = Lang::get('');
		$alert['message'] = Lang::get('');

		return Redirect::back()->with($alert);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$data['title']  = Lang::get('');
		$data['active'] = 2;
		$data['query']  = Words::find($id)->get();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(WordValidation $request, $id) {
		$word = new Words;
		$word->user_id      = $request->userID;
		$word->region_id    = $request->regionID;
		$word->word         = $request->word;
		$word->word_an      = $request->word_an;
		$word->word_fonetic = $request->word_fonetic;
		$word->dialect      = $request->dialect;
		$word->description  = $request->save();
		$word->save();

		$alert['class']   = Lang::get('');
		$alert['heading'] = Lang::get('');
		$alert['message'] = Lang::get('');

		return Redirect::back()->with($alert);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$data['title']  = Lang::get();
		$data['active'] = 2;
		$data['query']  =

		return view();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$word = Words::find($id);
		$word->delete();

		$alert['class']   = Lang::get('');
		$alert['heading'] = Lang::get('');
		$alert['message'] = Lang::get('');

		return Redirect::back()->with($alert);
	}

}
