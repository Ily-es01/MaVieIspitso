<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>

            :root{
                --transition-standard: all 0.3s ease;
            }
            .annonce-section{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: white;
            border-radius: 30px;
            margin-top: 20px;
            gap: 20px;
        }
        .annonce-header{
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: solid 0.5px rgb(211, 211, 211) ;
        }
        .annonce-header img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
}
        .user-info{
            display: flex;
            flex-direction: column;
        }

        .user-info span:first-of-type{
            font-weight: bold;
            font-size: 18px;
        }

        .user-info span:last-of-type{
            font-size: 12px;
            margin-top: 4px;
        }

        .annonce{
            background-color: white;
            width: 95%;
            margin-top: 20px;
            border: none;
            padding-bottom: 40px;
            padding-left: 40px;
            padding-right: 40px;
            padding-top: 20px;
            border-radius: 10px;
        }

      .pagination {
    margin-top: 25px;
    font-family: 'Inter', sans-serif;
    font-size: 13px;
}

.pagination nav {
    display: flex;
    justify-content: center;
}

.pagination ul {
    display: flex;
    list-style-type: none;
    gap: 5px;
    padding: 0;
    margin: 0;
}

.pagination li {
    display: flex;
}

.pagination .page-link {
    padding: 4px 10px;
    border-radius: 6px;
    color: #555;
    text-decoration: none;
    transition: var(--transition-standard);
}

.pagination a.page-link:hover {
    background-color: #f5f5f5;
}

.pagination .active .page-link {
    background-color: #2563eb;
    color: white;
}

.pagination .disabled .page-link {
    color: #ccc;
    pointer-events: none;
}

    </style>
    <title>Document</title>
</head>
<body>
    <x-nav-barre></x-nav-barre>

    <main style="margin-top : 20px; margin-bottom:20px;display:flex; align-items:center; flex-direction:column;">

        @foreach ($annonces as $annonce )
             <div class="annonce">
            <div class="annonce-header">
                <img src="{{ asset('images/enseignant-images/'.$annonce->user->Profile_image) }}">
                <div class="user-info">
                    <span>{{$annonce->user->name}} {{$annonce->user->Prenom}}</span>
                    <span>{{ \Carbon\Carbon::parse($annonce->Date_annonce)->locale('fr')->isoFormat('D MMMM Y') }}
</span>
                </div>

            </div>
            <div class="annonce-content">
                {{ $annonce->Contenu_annonce }}
            </div>
        </div>

        @endforeach
        <div class="pagination">
            {{ $annonces->links('vendor.pagination.bootstrap-5') }}
        </div>



    </main>

</body>
</html>
