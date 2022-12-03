<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Evaluator;
use App\Models\Faculty;
use App\Models\Questionaire;
use App\Models\Results;
use App\Models\Schedule;
use App\Models\SubjectList;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

   
    public function run()
    {
         $a = date('Y');
    $b = date('Y') + 1;
    $sy_result = $a.' - '.$b;
        $user = new User;
        $user->name = 'Main Administrator';
        $user->username = 'admin';
        $user->campus = 'CPSU Kabangkalan Campus';
        $user->password = Hash::make('admin');
        $user->academic_rank = 'Main Administrator Campus';
        $user->save();

        $user = new User;
        $user->name = 'ABELLO, Mark Anthony G.';
        $user->username = 'admin1';
        $user->campus = 'CPSU Hinoba-an Campus';
        $user->password = Hash::make('admin');
        $user->academic_rank = 'Campus Administrator';
        $user->save();

        $user = new User;
        $user->name = 'FERARIS, Erwin P., PhD';
        $user->username = 'admin2';
        $user->campus = 'CPSU Sipalay Campus';
        $user->password = Hash::make('admin');
        $user->academic_rank = 'Campus Administrator';
        $user->save();


        $user = new User;
        $user->name = 'BORRES, Germa T., PhD';
        $user->username = 'admin3';
        $user->campus = 'CPSU Cauayan Campus';
        $user->password = Hash::make('admin');
        $user->academic_rank = 'Campus Administrator';
        $user->save();

        $user = new User;
        $user->name = 'CORPUZ Filipina G.';
        $user->username = 'admin4';
        $user->campus = 'CPSU Ilog Campus';
        $user->password = Hash::make('admin');
        $user->academic_rank = 'Campus Administrator';
        $user->save();


        $user = new User;
        $user->name = 'MISAJON, Chim C., PhD';
        $user->username = 'admin5';
        $user->campus = 'CPSU Candoni Campus';
        $user->password = Hash::make('admin');
        $user->academic_rank = 'Campus Administrator';
        $user->save();

        $user = new User;
        $user->name = 'PREDO, Gregorio D.';
        $user->username = 'admin6';
        $user->campus = 'CPSU Hinigaran Campus';
        $user->password = Hash::make('admin');
        $user->academic_rank = 'Campus Administrator';
        $user->save();


        $user = new User;
        $user->name = 'GONZALES, Patrocenio L.';
        $user->username = 'admin7';
        $user->campus = 'CPSU Moises Padilla Campus';
        $user->password = Hash::make('admin');
        $user->academic_rank = 'Campus Administrator';
        $user->save();


        $user = new User;
        $user->name = 'FORDENTE, Noel B.';
        $user->username = 'admin8';
        $user->campus = 'CPSU Victorias Campus';
        $user->password = Hash::make('admin');
        $user->academic_rank = 'Campus Administrator';
        $user->save();


        $user = new User;
        $user->name = 'BALOGO, Ken M';
        $user->username = 'admin9';
        $user->campus = 'CPSU San Carlos Campus';
        $user->password = Hash::make('admin');
        $user->academic_rank = 'Campus Administrator';
        $user->save();

        


        $user = new Schedule;
        $user->campusid = 2;
        $user->campus = 'CPSU Hinoba-an Campus';
        $user->start = date("Y"."-"."m"."-"."d");
        $user->end = date("Y"."-"."m"."-"."d", strtotime('+ 2 days'));
        $user->semester = '1st Semester';
            $user->sy = $sy_result;
        $user->save();

        $user = new Schedule;
        $user->campusid = 3;
        $user->campus = 'CPSU Sipalay Campus';
        $user->start = date("Y"."-"."m"."-"."d");
        $user->end = date("Y"."-"."m"."-"."d", strtotime('+ 2 days'));
        $user->semester = '1st Semester';
            $user->sy = $sy_result;
        $user->save();

        $user = new Schedule;
        $user->campusid = 4;
        $user->campus = 'CPSU Cauayan Campus';
        $user->start = date("Y"."-"."m"."-"."d");
        $user->end = date("Y"."-"."m"."-"."d", strtotime('+ 2 days'));
        $user->semester = '1st Semester';
            $user->sy = $sy_result;
        $user->save();

        $user = new Schedule;
        $user->campusid = 5;
        $user->campus = 'CPSU Ilog Campus';
        $user->start = date("Y"."-"."m"."-"."d");
        $user->end = date("Y"."-"."m"."-"."d", strtotime('+ 2 days'));
        $user->semester = '1st Semester';
            $user->sy = $sy_result;
        $user->save();

        $user = new Schedule;
        $user->campusid = 6;
        $user->campus = 'CPSU Candoni Campus';
        $user->start = date("Y"."-"."m"."-"."d");
        $user->end = date("Y"."-"."m"."-"."d", strtotime('+ 2 days'));
        $user->semester = '1st Semester';
            $user->sy = $sy_result;
        $user->save();


        $user = new Schedule;
        $user->campusid = 7;
        $user->campus = 'CPSU Hinigaran Campus';
        $user->start = date("Y"."-"."m"."-"."d");
        $user->end = date("Y"."-"."m"."-"."d", strtotime('+ 2 days'));
        $user->semester = '1st Semester';
            $user->sy = $sy_result;
        $user->save();

        $user = new Schedule;
        $user->campusid = 8;
        $user->campus = 'CPSU Moises Padilla Campus';
        $user->start = date("Y"."-"."m"."-"."d");
        $user->end = date("Y"."-"."m"."-"."d", strtotime('+ 2 days'));
        $user->semester = '1st Semester';
            $user->sy = $sy_result;
        $user->save();

        $user = new Schedule;
        $user->campusid = 9;
        $user->campus = 'CPSU Victorias Campus';
        $user->start = date("Y"."-"."m"."-"."d");
        $user->end = date("Y"."-"."m"."-"."d", strtotime('+ 2 days'));
        $user->semester = '1st Semester';
            $user->sy = $sy_result;
        $user->save();


        $user = new Schedule;
        $user->campusid = 10;
        $user->campus = 'CPSU San Carlos Campus';
        $user->start = date("Y"."-"."m"."-"."d");
        $user->end = date("Y"."-"."m"."-"."d", strtotime('+ 2 days'));
        $user->semester = '1st Semester';
            $user->sy = $sy_result;
        $user->save();


         for ($i=0; $i < 10; $i++) { 
            $user = new Evaluator;
            $user->id_number = 'Student CPSU'.$i;
            $user->campusid = 2;
            $user->campus = 'CPSU Hinoba-an Campus';
            $user->password = Hash::make('admin');
            $user->course = 'College of Computer Studies';
            $user->evaluator_rank = 'Student';
            $user->academic_rank = 'Student';
            $user->school_year = '3rd Year';
            $user->section = 'Section A';
            $user->class_status = 'Irregular';
            $user->semester = '1st Semester';
            $user->sy = $sy_result;
            $user->save();
        }
        for ($i=0; $i < 10; $i++) { 
            $user = new Evaluator;
            $user->id_number = 'Student CPSU A'.$i;
            $user->campusid = 2;
            $user->campus = 'CPSU Hinoba-an Campus';
            $user->password = Hash::make('admin');
            $user->course = 'College of Computer Studies';
            $user->evaluator_rank = 'Student';
            $user->academic_rank = 'Student';
            $user->school_year = '3rd Year';
            $user->section = 'Section A';
            $user->class_status = 'Regular';
            $user->semester = '1st Semester';
            $user->sy = $sy_result;
            $user->save();
        }


        for ($i=0; $i < 10; $i++) { 
            $user = new Faculty;
            $user->id_number = 'Faculty '.$i;
            $user->campusid = 2;
            $user->password = Hash::make('admin');
            $user->campus = 'CPSU Hinoba-an Campus';
            $user->photos = 'sample.jpg';
            $user->name = 'name'.$i;
            $user->department = 'College of Computer Studies';
            $user->academic_rank = 'PSI II';
            $user->sy = $sy_result;
            $user->save();
        }
    

            $user = new Questionaire;
            $user->q1 = "Demonstrates sensitivity to students' ability to attend and absorb content information.";
            $user->q2 = 'Integrates sensitively his/her learning objectives with those of the students in a collaborative process.';
            $user->q3 = 'Makes self-available to students beyond official time.';
            $user->q4 = 'Regularly comes to class on time, well-groomed and well-prepared to complete assigned responsibilities.';
            $user->q5 = "Keeps accurate records of students' performance and prompt submission of the same.";
            $user->q6 = 'Demonstrates mastery of the subject matter (explain the subject matter without relying solely on the prescribed textbook).';
            $user->q7 = 'Draws and share information on the state on the art of theory and practice in his/her discipline.';
            $user->q8 = 'Integrates subject to practical circumstances and learning intents/purposes of students.';
            $user->q9 = 'Explains the relevance of present topics to the previous lessons, and relates the subject matter to relevant current issues and/or daily life activities.';
            $user->q10 = 'Demonstrates up-to-date knowledge and/or awareness on current trends and issues of the subject.';
            $user->q11 = 'Creates teaching strategies that allow students to practice using concepts they need to understand (interactive discussion).';
            $user->q12 = "Enhances student self-esteem and/or gives due recognition to students' performance/potentials.";
            $user->q13 = 'Allows students to create their own course with objectives and realistically defined student-professor rules and make them accountable for their performance.';
            $user->q14 = 'Allows students to think independently and make their own decisions and holding them accountable for their performance based largely on their success in executing decisions.';
            $user->q15 = 'Encourages students to learn beyond what is required and help/guide the students how to apply the concepts learned.';
            $user->q16 = 'Creates opportunities for intensive and/or extensive contribution of students in the class activities (e.g. breaks class into dyads, triads or buzz/task groups).';
            $user->q17 = 'Assumes roles as facilitator, resource person, coach, inquisitor, integrator, referee in drawing students to contribute to knowledge and understanding of the concepts at hands.';
            $user->q18 = 'Designs and implements learning conditions and experience that promotes healthy exchange and/or confrontations.';
            $user->q19 = 'Structures/re-structures learning and teaching-learning context to enhance attainment of collective learning objectives.';
            $user->q20 = 'Use of Instructional Materials (audio/video materials: fieldtrips, film showing, computer aided instruction and etc.) to reinforces learning processes.';
            $user->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'CCIT 01- INTRODUCTION TO COMPUTING';
            $subject->department = 'College of Computer Studies';
            $subject->semester = '1st Semester';
            $subject->year = '1st Year';
            $subject->save();

             $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'CCIT 02- COMPUTER PROGRAMMING';
            $subject->department = 'College of Computer Studies';
            $subject->semester = '1st Semester';
            $subject->year = '1st Year';
            $subject->save();

             $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'GEC 1- Understanding the Self';
            $subject->department = 'College of Computer Studies';
            $subject->semester = '1st Semester';
            $subject->year = '1st Year';
            $subject->save();

             $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'GEC 2- Reading in Philippine History';
            $subject->department = 'College of Computer Studies';
            $subject->semester = '1st Semester';
            $subject->year = '1st Year';
            $subject->save();

             $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'GEC 4 - Mathematics in the Modern World';
            $subject->department = 'College of Computer Studies';
            $subject->semester = '1st Semester';
            $subject->year = '1st Year';
            $subject->save();

             $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'GEC 5- Purposive Communication';
            $subject->department = 'College of Computer Studies';
            $subject->semester = '1st Semester';
            $subject->year = '1st Year';
            $subject->save();


             $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'GEC 6 - Art Appreciation';
            $subject->department = 'College of Computer Studies';
            $subject->semester = '1st Semester';
            $subject->year = '1st Year';
            $subject->save();


             $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'PE1 - Movement Enhancement';
            $subject->department = 'College of Computer Studies';
            $subject->semester = '1st Semester';
            $subject->year = '1st Year';
            $subject->save();


             $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'CCIT 04- DATA STRUCTURES AND ALGORITHM';
            $subject->department = 'College of Computer Studies';
            $subject->semester = '1st Semester';
            $subject->year = '2nd Year';
            $subject->save();


             $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'PCIT 03- INTEGRATIVE PROGRAMMING AND TECHNOLOGIES 1';
            $subject->department = 'College of Computer Studies';
            $subject->semester = '1st Semester';
            $subject->year = '2nd Year';
            $subject->save();


             $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'PFIT 01- PLATFORM TECHNOLOGIES';
            $subject->department = 'College of Computer Studies';
            $subject->semester = '1st Semester';
            $subject->year = '2nd Year';
            $subject->save();


             $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'PCIT 04- INTRODUCTION TO HUMAN COMPUTER INTERACTION';
            $subject->department = 'College of Computer Studies';
            $subject->semester = '1st Semester';
            $subject->year = '2nd Year';
            $subject->save();


             $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'PCIT 05- SOCIAL AND PROFESSIONAL ISSUES';
            $subject->department = 'College of Computer Studies';
            $subject->semester = '1st Semester';
            $subject->year = '2nd Year';
            $subject->save();

             $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'GEL 2 - Philippine Indigenous Communities';
            $subject->department = 'College of Computer Studies';
            $subject->semester = '1st Semester';
            $subject->year = '2nd Year';
            $subject->save();

            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'PE 3- PATH FIT 1';
            $subject->department = 'College of Computer Studies';
            $subject->semester = '1st Semester';
            $subject->year = '2nd Year';
            $subject->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'CCIT 06- APPLICATIONS DEVELOPMENT AND EMERGING TECHNOLOGY';
            $subject->department = 'College of Computer Studies';
            $subject->semester = '1st Semester';
            $subject->year = '3rd Year';
            $subject->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'PFIT 03- WEB SYSTEMS AND TECHNOLOGY';
            $subject->department = 'College of Computer Studies';
            $subject->semester = '1st Semester';
            $subject->year = '3rd Year';
            $subject->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'PCIT 09- NETWORKING 2';
            $subject->department = 'College of Computer Studies';
            $subject->semester = '1st Semester';
            $subject->year = '3rd Year';
            $subject->save();

             $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'PCIT 11- SYSTEM ADMINISTRATION AND MAINTENANCE';
            $subject->department = 'College of Computer Studies';
            $subject->semester = '1st Semester';
            $subject->year = '3rd Year';
            $subject->save();

            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'PSIT 04- TECHNOPRENUERSHIP';
            $subject->department = 'College of Computer Studies';
            $subject->semester = '1st Semester';
            $subject->year = '3rd Year';
            $subject->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'PSIT 03- IT SECURITY AND MANAGEMENT';
            $subject->department = 'College of Computer Studies';
            $subject->semester = '1st Semester';
            $subject->year = '3rd Year';
            $subject->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'GEL 9- Life and Works and Writings of Dr. Jose Rizal 3';
            $subject->department = 'College of Computer Studies';
            $subject->semester = '1st Semester';
            $subject->year = '3rd Year';
            $subject->save();

            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'GEC 1- Understanding the Self';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '1st Year';
            $subject->save();

            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'GEC 2- Reading in Philippine History';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '1st Year';
            $subject->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'GEC 4 - Mathematics in the Modern World';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '1st Year';
            $subject->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'GEC 5 - Purposive Communication';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '1st Year';
            $subject->save();

            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'GEC 6 - Art Appreciation';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '1st Year';
            $subject->save();

            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'Prof.Ed.1- The Child and Adolescent Learners and Learning Principles';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '1st Year';
            $subject->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'Prof.Ed. 2- Teaching Profession';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '1st Year';
            $subject->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'Sci. 1 - Teaching Science in Elementary Grades (Biology and Chemistry)';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '1st Year';
            $subject->save();

            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'PE 1- Movement Enhancement';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '1st Year';
            $subject->save();

            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'NSTP- National Service Training Program 1';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '1st Year';
            $subject->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'GEL 2 - Philippine Indigenous Communities';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '2nd Year';
            $subject->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'Prof.Ed. 5 -Technology for Teaching and Learning 1';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '2nd Year';
            $subject->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'Prof. Ed 6- Assessment in Student Learning';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '2nd Year';
            $subject->save();

            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'STAT- Elementary Statistics';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '2nd Year';
            $subject->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'TLE 1- Edukasyong Pantahanan at Pangkabuhayan';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '2nd Year';
            $subject->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'MATH 1- Teaching Math in the Primary Grade';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '2nd Year';
            $subject->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'ENG. 1 - Teaching English in Elementary Grades';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '2nd Year';
            $subject->save();

            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'VED 1- Good Manners and Right Conduct (Edukasyon sa Pagpakatao)';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '2nd Year';
            $subject->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'PE 3- Physical Activities Towards Health and Fitness I';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '2nd Year';
            $subject->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'GEM- Life and Works of Rizal';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '3rd Year';
            $subject->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'Prof.Ed. 9- The Teacher and the Social Curriculum';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '3rd Year';
            $subject->save();

            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'Prof. Ed. 10- Building and Enhancing New Literacies Across Curriculum';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '3rd Year';
            $subject->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'SSC 1- Teaching Social Studies in the Elementary Grades (Philippine History & Government)';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '3rd Year';
            $subject->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'FIL 1 - Pagtuturo ng Filipino sa Elementarya I - Estruktura at Gamit ng Wikang Filipino';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '3rd Year';
            $subject->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'TTL 2- Technology for Teaching and Learning in Elementary Grades';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '3rd Year';
            $subject->save();

            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'Research 2- Research in Education';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '3rd Year';
            $subject->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'FS 1- Field Study 1- Observation of Teaching and Learning in Actual School Environment';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '4th Year';
            $subject->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'FS 2- Field Study 2- Participation and Teaching Assistantship';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '4th Year';
            $subject->save();


            $subject = new SubjectList;
            $subject->sy = $sy_result;
            $subject->subject = 'ST 2- Special Topic- Program Outcomes Assessment';
            $subject->department = 'College of Teachers Education';
            $subject->semester = '1st Semester';
            $subject->year = '4th Year';
            $subject->save();

            // $subject = new SubjectList;
            //$subject->sy = $sy_result;
            // $subject->subject = '';
            // $subject->department = 'College of Teachers Education';
            // $subject->semester = '1st Semester';
            // $subject->save();


            // $subject = new SubjectList;
            //$subject->sy = $sy_result;
            // $subject->subject = '';
            // $subject->department = '';
            // $subject->semester = '1st Semester';
            // $subject->save();


            // $subject = new SubjectList;
            //$subject->sy = $sy_result;
            // $subject->subject = '';
            // $subject->department = '';
            // $subject->semester = '1st Semester';
            // $subject->save();


            // $subject = new SubjectList;
            //$subject->sy = $sy_result;
            // $subject->subject = '';
            // $subject->department = '';
            // $subject->semester = '1st Semester';
            // $subject->save();

            // $subject = new SubjectList;
            //$subject->sy = $sy_result;
            // $subject->subject = '';
            // $subject->department = '';
            // $subject->semester = '1st Semester';
            // $subject->save();


            // $subject = new SubjectList;
            //$subject->sy = $sy_result;
            // $subject->subject = '';
            // $subject->department = '';
            // $subject->semester = '1st Semester';
            // $subject->save();


            // $subject = new SubjectList;
            //$subject->sy = $sy_result;
            // $subject->subject = '';
            // $subject->department = '';
            // $subject->semester = '1st Semester';
            // $subject->save();


            // $subject = new SubjectList;
            //$subject->sy = $sy_result;
            // $subject->subject = '';
            // $subject->department = '';
            // $subject->semester = '1st Semester';
            // $subject->save();

            // $subject = new SubjectList;
            //$subject->sy = $sy_result;
            // $subject->subject = '';
            // $subject->department = '';
            // $subject->semester = '1st Semester';
            // $subject->save();


            // $subject = new SubjectList;
            //$subject->sy = $sy_result;
            // $subject->subject = '';
            // $subject->department = '';
            // $subject->semester = '1st Semester';
            // $subject->save();


            // $subject = new SubjectList;
            //$subject->sy = $sy_result;
            // $subject->subject = '';
            // $subject->department = '';
            // $subject->semester = '1st Semester';
            // $subject->save();


            // $subject = new SubjectList;
            //$subject->sy = $sy_result;
            // $subject->subject = '';
            // $subject->department = '';
            // $subject->semester = '1st Semester';
            // $subject->save();

            // $subject = new SubjectList;
            //$subject->sy = $sy_result;
            // $subject->subject = '';
            // $subject->department = '';
            // $subject->semester = '1st Semester';
            // $subject->save();


            // $subject = new SubjectList;
            //$subject->sy = $sy_result;
            // $subject->subject = '';
            // $subject->department = '';
            // $subject->semester = '1st Semester';
            // $subject->save();


            // $subject = new SubjectList;
            //$subject->sy = $sy_result;
            // $subject->subject = '';
            // $subject->department = '';
            // $subject->semester = '1st Semester';
            // $subject->save();


            // $subject = new SubjectList;
            //$subject->sy = $sy_result;
            // $subject->subject = '';
            // $subject->department = '';
            // $subject->semester = '1st Semester';
            // $subject->save();

            // $subject = new SubjectList;
            //$subject->sy = $sy_result;
            // $subject->subject = '';
            // $subject->department = '';
            // $subject->semester = '1st Semester';
            // $subject->save();


            // $subject = new SubjectList;
            //$subject->sy = $sy_result;
            // $subject->subject = '';
            // $subject->department = '';
            // $subject->semester = '1st Semester';
            // $subject->save();


            // $subject = new SubjectList;
            //$subject->sy = $sy_result;
            // $subject->subject = '';
            // $subject->department = '';
            // $subject->semester = '1st Semester';
            // $subject->save();





        
    }
}
