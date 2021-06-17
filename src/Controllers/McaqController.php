<?php

namespace edgewizz\mcaq\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Media;
use Edgewizz\Edgecontent\Models\ProblemSetQues;
use Edgewizz\Mcaq\Models\McaqAns;
use Edgewizz\Mcaq\Models\McaqQues;
use Illuminate\Http\Request;

class McaqController extends Controller
{
    public function store(Request $request){
        $pmQ = new McaqQues();
        $pmQ->question              = $request->question;
        $pmQ->format_title          = $request->format_title;
        $pmQ->difficulty_level_id   = $request->difficulty_level_id;
        if($request->question_media){
            $question_media = new Media();
            $request->question_media->storeAs('public/audio/mcaq', time().$request->question_media->getClientOriginalName());
            $question_media->url = 'audio/mcaq/'.time().$request->question_media->getClientOriginalName();
            $question_media->save();
        }
        $pmQ->media_id = $question_media->id;
        $pmQ->hint = $request->hint;
        $pmQ->save();
        /* answer1 */
        if($request->answer_1){
            $answer_1 = new McaqAns();
            $answer_1->question_id      = $pmQ->id;
            $answer_1->answer           = $request->answer_1;
            if ($request->ans_correct_1) {
                $answer_1->arrange = 1;
            }
            $answer_1->eng_word = $request->eng_word1;
            $answer_1->save();
        }
        /* //answer1 */
        /* answer2 */
        if($request->answer_2){
            $answer_2 = new McaqAns();
            $answer_2->question_id      = $pmQ->id;
            $answer_2->answer           = $request->answer_2;
            if ($request->ans_correct_2) {
                $answer_2->arrange = 1;
            }
            $answer_2->eng_word = $request->eng_word2;
            $answer_2->save();
        }
        /* //answer2 */
        /* answer3 */
        if($request->answer_3){
            $answer_3 = new McaqAns();
            $answer_3->question_id      = $pmQ->id;
            $answer_3->answer           = $request->answer_3;
            if ($request->ans_correct_3) {
                $answer_3->arrange = 1;
            }
            $answer_3->eng_word = $request->eng_word3;
            $answer_3->save();
        }
        /* //answer3 */
        /* answer4 */
        if($request->answer_4){
            $answer_4 = new McaqAns();
            $answer_4->question_id      = $pmQ->id;
            $answer_4->answer           = $request->answer_4;
            if ($request->ans_correct_4) {
                $answer_4->arrange = 1;
            }
            $answer_4->eng_word = $request->eng_word4;
            $answer_4->save();
        }
        /* //answer4 */
        /* answer5 */
        if($request->answer_5){
            $answer_5 = new McaqAns();
            $answer_5->question_id      = $pmQ->id;
            $answer_5->answer           = $request->answer_5;
            if ($request->ans_correct_5) {
                $answer_5->arrange = 1;
            }
            $answer_5->eng_word = $request->eng_word5;
            $answer_5->save();
        }
        /* //answer5 */
        /* answer6 */
        if($request->answer_6){
            $answer_6 = new McaqAns();
            $answer_6->question_id      = $pmQ->id;
            $answer_6->answer           = $request->answer_6;
            if ($request->ans_correct_6) {
                $answer_6->arrange = 1;
            }
            $answer_6->eng_word = $request->eng_word6;
            $answer_6->save();
        }
        /* //answer6 */
        /* answer7 */
        if($request->answer_7){
            $answer_7 = new McaqAns();
            $answer_7->question_id      = $pmQ->id;
            $answer_7->answer           = $request->answer_7;
            if ($request->ans_correct_7) {
                $answer_7->arrange = 1;
            }
            $answer_7->eng_word = $request->eng_word7;
            $answer_7->save();
        }
        /* //answer7 */
        /* answer8 */
        if($request->answer_8){
            $answer_8 = new McaqAns();
            $answer_8->question_id      = $pmQ->id;
            $answer_8->answer           = $request->answer_8;
            if ($request->ans_correct_8) {
                $answer_8->arrange = 1;
            }
            $answer_8->eng_word = $request->eng_word8;
            $answer_8->save();
        }
        /* //answer8 */
        
        if($request->problem_set_id && $request->format_type_id){
            $pbq = new ProblemSetQues();
            $pbq->problem_set_id = $request->problem_set_id;
            $pbq->question_id = $pmQ->id;
            $pbq->format_type_id = $request->format_type_id;
            $pbq->save();
        }
        return back();
    }
    public function edit($id, Request $request){
        $q = McaqQues::where('id', $id)->first();
        if($request->format_title){
            $q->format_title = $request->format_title;
        }
        $q->question = $request->question;
        $q->difficulty_level_id = $request->difficulty_level_id;
        // $q->level_id = $request->question_level;
        /* image1 */
        if($request->question_media){
        $question_media = new Media();
        $request->question_media->storeAs('public/audio/mcaq', time() . $request->question_media->getClientOriginalName());
        $question_media->url = 'audio/mcaq/' . time() . $request->question_media->getClientOriginalName();
        $question_media->save();
        $q->media_id = $question_media->id;
        }
        /* image1 */
        // $q->score = $request->question_score;
        $q->hint = $request->hint;
        $q->save();
        $answers = McaqAns::where('question_id', $q->id)->get();
        foreach($answers as $ans){
            $inputAnswer = 'answer'.$ans->id;
            if($request->$inputAnswer){
                $inputArrange = 'ans_correct'.$ans->id;
                $ans->answer = $request->$inputAnswer;
                $inputEngWord = 'eng_word'.$ans->id;
                $ans->eng_word = $request->$inputEngWord;
                if($request->$inputArrange){
                    $ans->arrange = 1;
                }else{
                    $ans->arrange = 0;
                }
                $ans->save();
            }
        }
        /* $anss = McaqAns::where('question_id', $q->id)->get();
        foreach($anss as $ans){
            $inputImage = 'answer_'.$ans->id.'_audio';
            if($request->$inputImage){
                $audio = new Media();
                $request->$inputImage->storeAs('public/questions', time().$request->$inputImage->getClientOriginalName());
                $audio->url = 'questions/'.time().$request->$inputImage->getClientOriginalName();
                $audio->save();
                $ans->media_id = $audio->id;
                $ans->save();
            }
        } */
        return back();
    }

    public function inactive($id){
        $f = McaqAns::where('id', $id)->first();
        $f->active = '0';
        $f->save();
        return back();
    }
    public function active($id){
        $f = McaqAns::where('id', $id)->first();
        $f->active = '1';
        $f->save();
        return back();
    }

    public function imagecsv($question_image, $images){
        foreach($images as $valueImage){
            $uploadImage = explode(".", $valueImage->getClientOriginalName());
            if($uploadImage[0] == $question_image){
                // dd($valueImage);
                $media = new Media();
                $valueImage->storeAs('public/audio/mcaq', time() . $valueImage->getClientOriginalName());
                $media->url = 'audio/mcaq/' . time() . $valueImage->getClientOriginalName();
                $media->save();
                return $media->id;
            }
        }
    }
    public function csv_upload(Request $request)
    {

        $file = $request->file('file');
        $images = $request->file('audio');
        // dd($file);
        // File Details
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();
        // Valid File Extensions
        $valid_extension = array("csv");
        // 2MB in Bytes
        $maxFileSize = 2097152;
        // Check file extension
        if (in_array(strtolower($extension), $valid_extension)) {
            // Check file size
            if ($fileSize <= $maxFileSize) {
                // File upload location
                $location = 'uploads';
                // Upload file
                $file->move($location, $filename);
                // Import CSV to Database
                $filepath = public_path($location . "/" . $filename);
                // Reading file
                $file = fopen($filepath, "r");
                $importData_arr = array();
                $i = 0;
                while (($filedata = fgetcsv($file, 1000, ",")) !== false) {
                    $num = count($filedata);
                    // Skip first row (Remove below comment if you want to skip the first row)
                    if ($i == 0) {
                        $i++;
                        continue;
                    }
                    for ($c = 0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata[$c];
                    }
                    $i++;
                }
                fclose($file);
                // Insert to MySQL database
                foreach ($importData_arr as $importData) {
                    $insertData = array(
                        "question"      => $importData[1],
                        "media"         => $importData[2],
                        "answer1"       => $importData[3],
                        "arrange1"      => $importData[4],
                        "eng_word1"     => $importData[5],
                        "answer2"       => $importData[6],
                        "arrange2"      => $importData[7],
                        "eng_word2"     => $importData[8],
                        "answer3"       => $importData[9],
                        "arrange3"      => $importData[10],
                        "eng_word3"     => $importData[11],
                        "answer4"       => $importData[12],
                        "arrange4"      => $importData[13],
                        "eng_word4"     => $importData[14],
                        "answer5"       => $importData[15],
                        "arrange5"      => $importData[16],
                        "eng_word5"     => $importData[17],
                        "answer6"       => $importData[18],
                        "arrange6"      => $importData[19],
                        "eng_word6"     => $importData[20],
                        "answer7"       => $importData[21],
                        "arrange7"      => $importData[22],
                        "eng_word7"     => $importData[23],
                        "answer8"       => $importData[24],
                        "arrange8"      => $importData[25],
                        "eng_word8"     => $importData[26],                        
                        "level"         => $importData[27],
                        "hint"          => $importData[28],
                    );
                    // var_dump($insertData['answer1']);
                    /*  */
                    if ($insertData['question']) {
                        $fill_Q = new McaqQues();
                        $fill_Q->question = $insertData['question'];
                        if($request->format_title){
                            $fill_Q->format_title = $request->format_title;
                        }
                        if(!empty($insertData['level'])){
                            if($insertData['level'] == 'easy'){
                                $fill_Q->difficulty_level_id = 1;
                            }else if($insertData['level'] == 'medium'){
                                $fill_Q->difficulty_level_id = 2;
                            }else if($insertData['level'] == 'hard'){
                                $fill_Q->difficulty_level_id = 3;
                            }
                        }
                        if (!empty($insertData['media']) && $insertData['media'] != '') {
                            $media_id = $this->imagecsv($insertData['media'], $images);
                            $fill_Q->media_id = $media_id;
                        }
                        if ($insertData['hint'] == '-') {
                        }else{
                            $fill_Q->hint = $insertData['hint'];
                        }
                        $fill_Q->save();
                        if($request->problem_set_id && $request->format_type_id){
                            $pbq = new ProblemSetQues();
                            $pbq->problem_set_id = $request->problem_set_id;
                            $pbq->question_id = $fill_Q->id;
                            $pbq->format_type_id = $request->format_type_id;
                            $pbq->save();
                        }

                        for ($x = 1; $x <= 8; $x++) {
                            $f_answer  = $insertData['answer'.$x];
                            $f_arrange  = $insertData['arrange'.$x];
                            $f_eng_word  = $insertData['eng_word'.$x];
                            if ($f_answer == '-') {
                            } else {
                                $f_Ans = new McaqAns();
                                $f_Ans->question_id = $fill_Q->id;
                                $f_Ans->answer = $f_answer;
                                $f_Ans->arrange = $f_arrange;
                                if ($f_eng_word == '-') {
                                } else {
                                    $f_Ans->eng_word = $f_eng_word;
                                }
                                $f_Ans->save();
                            }
                        }
                        /* if ($insertData['answer1'] == '-') {
                        } else {
                            $f_Ans1 = new McaqAns();
                            $f_Ans1->question_id = $fill_Q->id;
                            $f_Ans1->answer = $insertData['answer1'];
                            $f_Ans1->arrange = $insertData['arrange1'];
                            if ($insertData['eng_word1'] == '-') {
                            } else {
                                $f_Ans1->eng_word = $insertData['eng_word1'];
                            }
                            $f_Ans1->save();
                        }
                        if ($insertData['answer2'] == '-') {
                        } else {
                            $f_Ans2 = new McaqAns();
                            $f_Ans2->question_id = $fill_Q->id;
                            $f_Ans2->answer = $insertData['answer2'];
                            $f_Ans2->arrange = $insertData['arrange2'];
                            if ($insertData['eng_word2'] == '-') {
                            } else {
                                $f_Ans2->eng_word = $insertData['eng_word2'];
                            }
                            $f_Ans2->save();
                        }
                        if ($insertData['answer3'] == '-') {
                        } else {
                            $f_Ans3 = new McaqAns();
                            $f_Ans3->question_id = $fill_Q->id;
                            $f_Ans3->answer = $insertData['answer3'];
                            $f_Ans3->arrange = $insertData['arrange3'];
                            if ($insertData['eng_word3'] == '-') {
                            } else {
                                $f_Ans3->eng_word = $insertData['eng_word3'];
                            }
                            $f_Ans3->save();
                        }
                        if ($insertData['answer4'] == '-') {
                        } else {
                            $f_Ans4 = new McaqAns();
                            $f_Ans4->question_id = $fill_Q->id;
                            $f_Ans4->answer = $insertData['answer4'];
                            $f_Ans4->arrange = $insertData['arrange4'];
                            if ($insertData['eng_word4'] == '-') {
                            } else {
                                $f_Ans4->eng_word = $insertData['eng_word4'];
                            }
                            $f_Ans4->save();
                        } */
                    }
                    /*  */
                }
                // Session::flash('message', 'Import Successful.');
            } else {
                // Session::flash('message', 'File too large. File must be less than 2MB.');
            }
        } else {
            // Session::flash('message', 'Invalid File Extension.');
        }
        return back();
    }

}
