@extends('layouts.app')
@include('layouts.navbar-student')

@section('content')
<h1 class="text-3xl font-bold mb-4">Student Dashboard</h1>
<h2 class="text-2xl font-semibold mb-6">Daftar Courses</h2>

<!-- Info mahasiswa -->
<div id="student-info" class="mb-6 p-4 bg-gray-100 rounded-md"></div>

<!-- Notification -->
<div id="notification" class="p-4 mb-4 bg-green-100 text-green-800 rounded-lg hidden">
    Data berhasil dimuat!
</div>

<!-- Form pemilihan course -->
<form id="enroll-form" method="POST" action="{{ route('student.courses.bulkEnroll') }}">
    @csrf
    <div id="course-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 w-full mb-4">
    </div>

    <p>Total SKS: <span id="total-credits">0</span></p>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
        Submit
    </button>
</form>

<script>
fetch("{{ route('student.courses.json') }}")
.then(res => res.json())
.then(data => {
    const student = data.student;
    const courses = data.courses;
    const enrolled = data.enrolled;

    // Tampilkan info mahasiswa
    const container = document.getElementById('student-info');
    const h3 = document.createElement('h3');
    h3.textContent = `${student.FULL_NAME} (${student.STUDENT_NUMBER})`;
    h3.classList.add('text-xl','font-semibold','mb-2');
    container.appendChild(h3);

    const courseList = document.getElementById('course-list');

    courses.forEach(course => {
        const div = document.createElement('div');
        div.classList.add('bg-white','p-4','rounded-xl','shadow-md','flex','flex-col','justify-between');

        const label = document.createElement('label');
        label.classList.add('flex','items-center','space-x-2');

        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.name = 'courses[]';
        checkbox.value = course.COURSE_ID;
        checkbox.dataset.credits = course.CREDITS;

        const span = document.createElement('span');
        span.textContent = `${course.COURSE_NAME} (${course.COURSE_CODE}) - SKS: ${course.CREDITS}`;

        // Jika sudah enrolled, disable checkbox & beri tanda
        if(enrolled.includes(course.COURSE_ID)){
            checkbox.disabled = true;
            span.textContent += ' (Enrolled)';
            span.classList.add('text-gray-400','italic');
        }

        label.appendChild(checkbox);
        label.appendChild(span);
        div.appendChild(label);
        courseList.appendChild(div);
    });

    // Update total SKS
    const totalCreditsSpan = document.getElementById('total-credits');
    courseList.addEventListener('change', () => {
        let total = 0;
        courseList.querySelectorAll('input[type=checkbox]:not(:disabled):checked').forEach(cb => {
            total += parseInt(cb.dataset.credits);
        });
        totalCreditsSpan.textContent = total;
    });

    // Validasi form sebelum submit
    const form = document.getElementById('enroll-form');
    form.addEventListener('submit', e => {
        const checked = courseList.querySelectorAll('input[type=checkbox]:not(:disabled):checked');
        if(checked.length === 0){
            e.preventDefault();
            alert('Pilih minimal 1 course!');
        }
    });
})
.catch(err => console.error(err));
</script>
@endsection

<script>
document.addEventListener('DOMContentLoaded', async function () {
    const notif = document.getElementById('notification');

    // tunggu 2 detik sebelum tampil
    await new Promise(resolve => setTimeout(resolve, 2000));
    notif.classList.remove('hidden');

    // tampil selama 3 detik
    await new Promise(resolve => setTimeout(resolve, 3000));
    notif.classList.add('hidden');
});
</script>