<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs Listings</title>
</head>
    <body>
        <h1>Avaiable jobs</h1>
        <ul>
            @forelse($jobs as $job)
                
                <li>{{$job}}</li>
            @empty
                <p>No Jobs avaiable</p>
            @endforelse
        </ul>
    </body>
</html>