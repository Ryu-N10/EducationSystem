<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Grade;
use App\Models\User;

class ProgressController extends Controller
{
    /**
     * 授業進捗画面を表示する
     */
    public function showProgress()
    {
        // ログイン中のユーザー情報を取得
        $user = Auth::user();

        // 【開発用の一時的な代替案（強制ログイン）】
        // もし誰もログインしていなければ、データベースの最初のユーザーを強制的に使う
        if (!$user) {
            $user = User::first();
            
            if (!$user) {
                dd('データベースにユーザーがいません。phpMyAdminを確認してください。');
            }
            
            // 取得したユーザーで強制的にログインした状態にする
            Auth::login($user);
        }

        // ユーザーの現在の学年情報を取得（リレーションを使用）
        $currentGrade = $user->grade;

        // 全ての学年と、それに紐づくカリキュラムを取得
        // さらに、現在のユーザーの進捗情報だけを絞り込んで一緒に取得する（Eager Loading）
        $grades = Grade::with(['curriculums' => function ($query) use ($user) {
            $query->with(['progresses' => function ($progressQuery) use ($user) {
                // 進捗テーブルから、このユーザーのデータだけを取得
                $progressQuery->where('users_id', $user->id);
            }]);
        }])->get();

        // 画面（ビュー）にデータを渡す
        return view('user.curriculum_progress', compact('user', 'currentGrade', 'grades'));
    }
}