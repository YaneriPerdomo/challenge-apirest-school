<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;



Route::get('/inicio', HomeController::class);
Route::get('/', HomeController::class);

Route::controller(SubjectController::class)->group(function () {
    Route::get('asignaturas', 'index')->name('subject.index');
    Route::get('asignaturas/{data}/filtrar', 'indexSearch')->name('subject.indexSearch');
    Route::get('asignatura/registrar', 'create')->name('subject.create');
    Route::post('asignatura/registrar', 'store')->name('subject.store');
    Route::get('asignatura/{slug}/editar', 'edit')->name('subject.edit');
    Route::put('asignatura/{slug}/editar', 'update')->name('subject.update');
    Route::get('asignatura/{slug}/eliminar', 'delete')->name('subject.delete');
    Route::delete('asignatura/{slug}/destruir', 'destroy')->name('subject.destroy');
});

Route::controller(StudentController::class)->group(function () {
    Route::get('alumnos', 'index')->name('student.index');
    Route::get('alumnos/{data}/filtrar', 'indexSearch')->name('subject.indexSearch');
    Route::get('alumno/registrar', 'create')->name('student.create');
    Route::post('alumno/registrar', 'store')->name('student.store');
    Route::get('alumno/{slug}/editar', 'edit')->name('student.edit-male');
    Route::get('alumna/{slug}/editar', 'edit')->name('student.edit-female');
    Route::put('alumna/{slug}/editar', 'update')->name('student.update');
    Route::get('alumno/{slug}/eliminar', 'delete')->name('student.delete-male');
    Route::get('alumna/{slug}/eliminar', 'delete')->name('student.delete-female');
    Route::delete('asignatura/{slug}/eliminar', 'destroy')->name('student.destroy');

    Route::get('alumno/{slug}/materias', 'subjects')->name('student.subjects-male');
    Route::get('alumna/{slug}/materias', 'subjects')->name('student.subjects-female');
    Route::put('alumno/{slug}/materia/actualizar', 'subjectsUpdate')->name('student.subjects-update');

    Route::get('alumno/{slug}/materia/registrar', 'subjectCreate')->name('student.subjects-male.create');
    Route::get('alumna/{slug}/materia/registrar', 'subjectCreate')->name('student.subjects-female.create');
    Route::post('alumna/{slug}/materia/registrar', 'subjectStore')->name('student.subjects-store');


    Route::get('alumno/{slug}/materia/{slug_m}/{slug_cali}/eliminar', 'subjectsDelete')->name('student.subjects-male.delete');
    Route::get('alumna/{slug}/materia/{slug_m}/{slug_cali}/eliminar', 'subjectsDelete')->name('student.subjects-female.delete');
    Route::delete('calificacion/{slug_student}/{slug_cali}', 'subjectsDestroy')->name('student.subjects-destroy');
});

Route::controller(TeacherController::class)->group(function () {
    Route::get('profesores', 'index')->name('teacher.index');
    Route::get('profesores/{data}/filtrar', 'indexSearch')->name('teacher.indexSearch');
    Route::get('profesor/registrar', 'create')->name('teacher.create');
    Route::post('profesore/registrar', 'store')->name('teacher.store');
    Route::get('profesor/{slug}/editar', 'edit')->name('teacher.edit-male');
    Route::get('profesora/{slug}/editar', 'edit')->name('teacher.edit-female');
    Route::put('profesores/{slug}/editar', 'update')->name('teacher.update');
    Route::get('profesor/{slug}/eliminar', 'delete')->name('teacher.delete-male');
    Route::get('profesora/{slug}/eliminar', 'delete')->name('teacher.delete-female');
    Route::delete('profesore/{slug}/eliminar', 'destroy')->name('teacher.destroy');
});
