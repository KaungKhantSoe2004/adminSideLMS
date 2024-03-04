@extends('layouts.app')
@section('body')
   <div class="  bg-white container-fluid">
<div class="ms-4  pt-4">
<h2 class=" border-bottom border-bottom-solid pb-3 text-center ">&nbsp; &nbsp; Create Lessons On KAMUI</h2>
<div class=" mt-3">
    <h3 class=" text-primary ms-3"> &nbsp; &nbsp;  About Us</h3>
    <h6 class=" text-dark">
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;    Lorem ipsum dolor sit amet consectetur adipisicing elit. Error expedita dolores exercitationem accusantium blanditiis quis. Nihil perferendis nesciunt voluptatibus unde placeat fugit eveniet veritatis. Atque eligendi enim similique nesciunt ipsum.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Error expedita dolores exercitationem accusantium blanditiis quis. Nihil perferendis nesciunt voluptatibus unde placeat fugit eveniet veritatis. Atque eligendi enim similique nesciunt ipsum.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Error expedita dolores exercitationem accusantium blanditiis quis. Nihil perferendis nesciunt voluptatibus unde placeat fugit eveniet veritatis. Atque eligendi enim similique nesciunt ipsum.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Error expedita dolores exercitationem accusantium blanditiis quis. Nihil perferendis nesciunt voluptatibus unde placeat fugit eveniet veritatis. Atque eligendi enim similique nesciunt ipsum.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Error expedita dolores exercitationem accusantium blanditiis quis. Nihil perferendis nesciunt voluptatibus unde placeat fugit eveniet veritatis. Atque eligendi enim similique nesciunt ipsum.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Error expedita dolores exercitationem accusantium blanditiis quis. Nihil perferendis nesciunt voluptatibus unde placeat fugit eveniet veritatis. Atque eligendi enim similique nesciunt ipsum.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Error expedita dolores exercitationem accusantium blanditiis quis. Nihil perferendis nesciunt voluptatibus unde placeat fugit eveniet veritatis. Atque eligendi enim similique nesciunt ipsum.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Error expedita dolores exercitationem accusantium blanditiis quis. Nihil perferendis nesciunt voluptatibus unde placeat fugit eveniet veritatis. Atque eligendi enim similique nesciunt ipsum.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Error expedita dolores exercitationem accusantium blanditiis quis. Nihil perferendis nesciunt voluptatibus unde placeat fugit eveniet veritatis. Atque eligendi enim similique nesciunt ipsum.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Error expedita dolores exercitationem accusantium blanditiis quis. Nihil perferendis nesciunt voluptatibus unde placeat fugit eveniet veritatis. Atque eligendi enim similique nesciunt ipsum.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Error expedita dolores exercitationem accusantium blanditiis quis. Nihil perferendis nesciunt voluptatibus unde placeat fugit eveniet veritatis. Atque eligendi enim similique nesciunt ipsum.
        Lorem ipsum dolor sit amet consectetur adipisicing el
    </h6>
</div>





<div class=" mt-5">
    <h3 class=" my-4 pt-5 text-center text-primary ms-1"> &nbsp;  How to Use Our LMS</h3>



    <div class="  col-12 row  my-5 text-dark">
        <div class=" col-md-6  col-12">
            <img src="{{asset('logo/lesson_learned.jpg')}}" class=" w-100 h-100" alt="">
        </div>
        <div class=" col-md-6 d-flex  order-md-first  align-items-center col-12">
          <div>
            <h1 class=" mb-3">
                Build Your <span class=" text-primary">Classes and subjects </span>
            </h1>
         <div class=" text-dark">
         &nbsp;  &nbsp;  &nbsp;  &nbsp;  First of all , If you just signed into our platform ,
         you will not have a class.So you can create a class on your own ,with two strong passwords
         (one password is used to sign in the class by other teachers and one for students) and after you have created
         the class ,you can see the class id and class passwords (used to sign in by other teachers and classes)
          on My Classes page.You can manage the class Passwords(Only if you are the creatore of the class).
          You have to give the teacher password to the teachers so they can sign in the class.
          For the students, you have to give the class id and password for students and so they can join the class as a student.
          You can join/create
          classes more than one and they will be shown in your classes page.You can create your subject by entering the class you want to
          in.
         </div>
         <a href="#">
            <button class=" btn btn-primary p-3 mt-4">Create Your Own Classes </button>
         </a>
         <a href="#">
            <button class=" btn btn-primary p-3 mt-4">Create Your Own Subjects</button>
         </a>
          </div>
        </div>
            </div>




            <div class="  pt-5  col-12 row  my-5 text-dark">
                <div class=" col-md-6  col-12">
                    <img src="{{asset('logo/join.jpg')}}" class=" w-100 h-100" alt="">
                </div>
                <div class=" col-md-6 d-flex   align-items-center col-12">
                  <div>
                    <h1 class=" mb-3">
                        Join <span class=" text-primary">Classes </span>
                    </h1>
                 <div class=" text-dark">
                 &nbsp;  &nbsp;  &nbsp;  &nbsp;  Also if you already had a class created by your co-worker or compannions ,
                 you can join that created class with the class id and the class password given by him/her and manage the subject in the classes.
                 Also the class id and class passwords (one for teachers and one for students) will be shown on classes page.You can give the student
                  password and class id to sign in to class and learn lessons.
                 You can manage the subjects in the class.
                 </div>
                 <a href="#">
                    <button class=" btn btn-primary p-3 mt-4">Join Classes</button>
                 </a>
                  </div>
                </div>
                    </div>



                    <div class="  pt-5  col-12 row  my-5 text-dark">
                        <div class=" col-md-6  col-12">
                            <img src="{{asset('logo/editTeacherAndStudent.jpg')}}" class=" w-100 h-100" alt="">
                        </div>
                        <div class=" col-md-6 d-flex  order-md-first   align-items-center col-12">
                          <div>
                            <h1 class=" mb-3">
                              Edit <span class=" text-primary">Users </span>
                            </h1>
                         <div class=" text-dark">
                         &nbsp;  &nbsp;  &nbsp;  &nbsp; You can manage the users both including teachers and students in the user list. If you are the creator of the class you have the access to manage both teachers accounts and student accounts.If you are not creatore , you only have access to manage student accounts.
                         </div>
                         <a href="#">
                            <button class=" btn btn-primary p-3 mt-4">Edit Teacher List</button>
                         </a>
                         <a class=" ps-5" href="#">
                            <button class="  ms-4 btn btn-primary p-3 mt-4">Edit Student List</button>
                         </a>
                          </div>
                        </div>
                            </div>

    <div class=" col-12 row  pt-5  mt-5 text-dark">
<div class=" col-md-6  col-12">
    <img src="{{asset('logo/Lesson-Plan-Maker-maker-share.jpg')}}" class=" w-100 h-100" alt="">
</div>
<div class=" col-md-6 d-flex    align-items-center col-12">
  <div>
    <h1 class=" mb-3">
        Make Your <span class=" text-primary">Lessons For Each Subject</span>
    </h1>
 <div class=" text-dark">
 &nbsp;  &nbsp;  &nbsp;  &nbsp;   Since the large video files and pdf files can cause database system an  error,
 your lesson video, pdf, and img files must be posted in youtube, google drive and embed the link and
 post the link in lesson link in our system.Here is the link how to embed the video links on you tube and google drive.
 <br>
 <a class=" btn  mt-2 btn-dark p-2" href="https://www.youtube.com/watch?v=xopvkx6CpNs" > Embed You Tube Videos and VEED Videos</a>
<a class=" btn mt-2 btn-dark p-2" href="https://www.youtube.com/watch?v=0zK5UjM8qMc"> Embed Google Drive Videos</a>
<a class=" btn mt-2 btn-dark p-2" href="https://www.youtube.com/watch?v=QHeVcN_XIik">Embed Google Drive PDF file</a>
 <Link></Link>
 </div>
 <a href="#">
    <button class=" col-12 btn btn-primary p-3 mt-4">Create Your Own Lessons</button>
 </a>
  </div>
</div>
    </div>


    <div class="  pt-5  col-12 row  my-5 text-dark">
        <div class=" col-md-6  col-12">
            <img src="{{asset('logo/chat.webp')}}" class=" w-100 h-100" alt="">
        </div>
        <div class=" col-md-6 d-flex  order-md-first   align-items-center col-12">
          <div>
            <h1 class=" mb-3">
              <span class=" text-primary">Chatting</span>
            </h1>
         <div class=" text-dark">
         &nbsp;  &nbsp;  &nbsp;  &nbsp;   Teachers can chat in the meeting rooms and you can chat in each classroom
          and also to the other teachers in dashboard.You can chat with students in student side website.
          Chat features include emoji and stickers.
         </div>
         <a href="#">
            <button class=" btn btn-primary p-3 mt-4">Join The Meeting</button>
         </a>

          </div>
        </div>
            </div>



            <div class="  pt-5  col-12 row  my-5 text-dark">
                <div class=" col-md-6  col-12">
                    <img src="{{asset('logo/assignment.webp')}}" class=" w-100 h-100" alt="">
                </div>
                <div class=" col-md-6 d-flex     align-items-center col-12">
                  <div>
                    <h1 class=" mb-3">
                     Make <span class=" text-primary">Assignments </span>
                    </h1>
                 <div class=" text-dark">
                 &nbsp;  &nbsp;  &nbsp;  &nbsp;   Teachers can make assignments to know whether the student takes
                 his class or not and also to check the understanding of the lectures by the student.The assignmenta
                 are valid for photos of written papers, and pdf files by the students.
                 </div>
                 <a href="#">
                    <button class=" btn btn-primary p-3 mt-4">Make Assignments</button>
                 </a>

                  </div>
                </div>
                    </div>


    <div class="  pt-5  col-12 row  my-5 text-dark">
        <div class=" col-md-6  col-12">
            <img src="{{asset('logo/teacherList.jpg')}}" class=" w-100 h-100" alt="">
        </div>
        <div class=" col-md-6 d-flex order-md-first   align-items-center col-12">
          <div>
            <h1 class=" mb-3">
    Check  <span class=" text-primary"> Assignments</span>
            </h1>
         <div class=" text-dark">
         &nbsp;  &nbsp;  &nbsp;  &nbsp;   We also stored data of students' assignment answer page and make sure that teachers can check and point them.So that students can pass the exam if they are truly understand it.
         Teachers can punish students who don't make assignments by closing the student account temporarily in the student list in related class page.
         </div>
         <a href="#">
            <button class=" btn btn-primary p-3 mt-4">Check Student Answers</button>
         </a>
          </div>
        </div>
            </div>
</div>

</div>
   </div>
@endsection
