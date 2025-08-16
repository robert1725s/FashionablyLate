<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;

class AdminController extends Controller
{
    public function admin()
    {
        // セッションから検索条件を取得
        if (session()->has('search_conditions')) {
            $searchParams = session('search_conditions');

            $contacts = Contact::with('category')->CategorySearch($searchParams['category_id'])->GenderSearch($searchParams['gender'])->DateSearch($searchParams['date'])->KeywordSearch($searchParams['keyword'])->Paginate(7);
        } else {
            $searchParams = null;

            $contacts = Contact::with('category')->Paginate(7);
        }

        $categories = Category::all();

        return view('admin', compact('contacts', 'categories',  'searchParams'));
    }

    public function search(Request $request)
    {
        $searchParams = [
            'keyword' => $request->keyword,
            'gender' => $request->gender,
            'category_id' => $request->category_id,
            'date' => $request->date,
        ];

        // セッションに検索条件を保存
        session(['search_conditions' => $searchParams]);

        return redirect('/admin');
    }

    public function reset()
    {
        // セッションの検索条件をクリア
        session()->forget('search_conditions');

        return redirect('/admin');
    }

    public function destroy(Request $request)
    {
        //idを元に問い合わせを削除
        Contact::find($request->id)->delete();

        return redirect('/admin');
    }

    public function export()
    {
        //検索条件を元にエクスポート対象を決定
        if (session()->has('search_conditions')) {
            $searchParams = session('search_conditions');

            $contacts = Contact::with('category')->CategorySearch($searchParams['category_id'])->GenderSearch($searchParams['gender'])->DateSearch($searchParams['date'])->KeywordSearch($searchParams['keyword'])->get();
        } else {
            $contacts = Contact::with('category')->get();
        }

        // CSVファイル名を生成
        $fileName = 'contacts_export_' . date('Y-m-d_H-i-s') . '.csv';

        // レスポンスヘッダーを設定
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        // コールバック関数でCSVを生成
        $callback = function () use ($contacts) {
            $file = fopen('php://output', 'w');

            // BOM付きUTF-8で日本語を正しく表示
            fwrite($file, "\xEF\xBB\xBF");

            // CSVヘッダー行を書き込み
            fputcsv($file, [
                'お名前',
                '性別',
                'メールアドレス',
                '電話番号',
                '住所',
                '建物名',
                'お問い合わせの種類',
                'お問い合わせ内容'
            ]);

            // データ行を書き込み
            foreach ($contacts as $contact) {
                // 性別の変換
                $gender = '';
                switch ($contact->gender) {
                    case 1:
                        $gender = '男性';
                        break;
                    case 2:
                        $gender = '女性';
                        break;
                    default:
                        $gender = 'その他';
                        break;
                }

                fputcsv($file, [
                    $contact->last_name . ' ' . $contact->first_name,
                    $gender,
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    $contact->category->content ?? '',
                    $contact->detail,
                ]);
            }

            fclose($file);
        };

        // ストリーミングレスポンスを返す
        return response()->stream($callback, 200, $headers);
    }
}
