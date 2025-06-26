<x-layout>
    <x-slot name="title">Create job</x-slot>
    <h1>Create New Job</h1>
    <form action="/jobs" method="POST">
        @csrf
        <input class="border-4 border-indigo-500 rounded-md" type="text" name="title" placeholder="title">
        <input class="border-4 border-indigo-500 rounded-md" type="text" name="description" placeholder="description">
        <button type="submit">Submit</button>
    </form>
</x-layout>
        