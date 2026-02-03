<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class QuizController extends Controller
{
    // The list of questions used by the view

    private $questions = [
        'Academic and Cognitive Stress' => [
            1 => "How often do you feel that your academic workload is overwhelming or unmanageable?",
            2 => "I struggle to focus on school tasks because my mind is filled with worrying thoughts.",
            3 => "How often do you feel anxious when thinking about deadlines, exams, or grades?",
            4 => "How often do you procrastinate because a school task feels mentally or emotionally 'too big' to start?",
            5 => "I feel disconnected or unmotivated toward the subjects I am studying.",
        ],
        'Emotional Stress and Self-Perception' => [
            6 => "How often do you feel emotionally drained by your daily life?",
            7 => "I feel mentally exhausted or drained from school, even before the day end.",
            8 => "How often do you feel disappointed in yourself even when you are doing reasonably well?",
            9 => "How often do you feel pressured to meet other people's expectations at the expense of your own needs?",
            10 => "I feel guilty when I try to rest or take breaks instead of being productive.",
        ],
        'Physical and Behavioral Stress Response' => [
            11 => "How often do you have difficulty sleeping because you are thinking about school-related concerns?",
            12 => "How often do you feel physically tense (e.g., headaches, tight shoulders, stomach discomfort) during academic tasks?",
            13 => "How often do you often feel physically tired even after getting enough sleep?",
            14 => "How often do you feel irritable or short-tempered because of stress?",
        ],
        'Social and Interpersonal Impact' => [
            15 => "How often do you feel emotionally drained after interacting with classmates or teachers?",
            16 => "How often do you feel that stress is affecting your relationship with others?",
            17 => "How often do you avoid asking for help because you worry about being judged or seen as incapable?",
        ],
        'Perceived Control and Overall Stress Impact' => [
            18 => "How often do you feel a lack of control over important areas of your life?",
            19 => "How often do you feel overwhelmed by the number of responsibilities in your overall?",
            20 => "How often do you feel that stress interferes with your ability to enjoy everyday activities?",
        ]
    ];


    public function index()
    {
        return view('quiz', ['questions' => $this->questions]);
    }

    public function submit(Request $request)
    {
        $rawScore = 0;
        for ($i = 1; $i <= 20; $i++) {
            $rawScore += $request->input('q' . $i, 0);
        }

        $finalScore = $rawScore * 1.25;

        if ($finalScore <= 33) {
            $result = ['level' => 'Low Stress', 'color' => 'text-green-600', 'bg' => 'bg-green-500'];
        } elseif ($finalScore <= 66) {
            $result = ['level' => 'Moderate Stress', 'color' => 'text-yellow-600', 'bg' => 'bg-yellow-500'];
        } else {
            $result = ['level' => 'High Stress', 'color' => 'text-red-600', 'bg' => 'bg-red-500'];
        }

        return back()->with([
            'score' => $finalScore,
            'level' => $result['level'],
            'color' => $result['color'],
            'bg' => $result['bg']
        ]);
    }
}
