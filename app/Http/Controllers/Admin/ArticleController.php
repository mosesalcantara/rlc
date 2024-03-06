<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\AboutItem;

class ArticleController extends Controller
{
    public function index() {
        return view('admin.articles.index');
    }

    public function get_all() {
        $records = AboutItem::join('articles', 'about_items.id', '=', 'articles.about_item_id')->get();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function get_related() {
        $records = AboutItem::all();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function create(Request $request) {
        $record = new Article;

        if( $request->hasFile( 'picture' ) ) {
            $file = $request->picture;
            $filename = time() . '.'.$file->clientExtension();
            $destination = 'uploads/articles/pictures';
            $file->move( $destination, $filename );
        }

        $record->title = $request->title;
        $record->text = $request->text;
        $record->picture = $filename;
        $record->about_item_id = $request->about_item_id;
        $record->save();

        return response(['msg' => 'Added Article']);
    }

    public function edit(Request $request) {
        $record = AboutItem::join('articles', 'about_items.id', '=', 'articles.about_item_id')->where('articles.id', $request->upd_id)->get();
        $record = $record[0];
        $records = AboutItem::all();

        $data = [
            'record' => $record,
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $record = Article::find($request->upd_id);

        if( $request->hasFile( 'picture' ) ) {
            $file = $request->picture;
            $filename = time() . '.'.$file->clientExtension();
            $destination = 'uploads/articles/pictures';
            $file->move( $destination, $filename );

            $record->update([
                'title' => $request->title,
                'text' => $request->text,
                'picture' => $filename,
                'about_item_id' => $request->about_item_id,
            ]);
        }
        else {
            $record->update([
                'title' => $request->title,
                'text' => $request->text,
                'about_item_id' => $request->about_item_id,
            ]);
        }

        return response(['msg' => 'Updated Article']);
    }

    public function delete(Request $request) {
        $record = Article::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Article']);
    }
}
