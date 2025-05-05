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

        .pagination{
            text-align: center;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .pagination a {
            text-decoration: none;
            padding: 15px;
            color: black;
        }

        .pagination a.active{
            background-color: #3b82f6;
            color: white ;
            border-radius: 5px;
        }

        .pagination a:hover:not(.active){
            background-color: rgb(216, 215, 215);
            border-radius: 5px;
            transition: var(--transition-standard);
        }
    </style>
    <title>Document</title>
</head>
<body>
    <x-nav-barre></x-nav-barre>

    <main style="margin-top : 20px; margin-bottom:20px;display:flex; align-items:center; flex-direction:column;">

            
        <div class="annonce">
            <div class="annonce-header">
                <img src="{{ asset('images/enseignant-images/smiling-showing-one-male-teacher-wearing-glasses-holding-number-fans-sitting-table-with-school-tools-classroom.jpg') }}">
                <div class="user-info">
                    <span>Abdelhafid Serghini</span>
                    <span>02 Mai 2025</span>
                </div>
                
            </div>
            <div class="annonce-content">
                Bonjour,
                Pour les étudiants qui sont sous mon encadrement en PFE et qui ne sont pas présents oujourd'hui dans la séance de PFE doivent se présenter demain au bureau du département à 15h 15.
            </div>
        </div>

            <div class="annonce">
                <div class="annonce-header">
                    <img src="{{ asset('images/enseignant-images/elegant-young-teacher-with-brunette-hair-stylish-light-shirt-black-striped-suit-glasses-holding-writings-pen-giving-lecture.jpg') }}">
                    <div class="user-info">
                        <span>Ibrahim Faraji</span>
                        <span>19 Avril 2025</span>
                    </div>
                    
                </div>
                <div class="annonce-content">
                    Pour le DS, il aura lieu de 12h00 à 13h00, salle 72.
    
                    Il portera sur la réunion, le rapport et le compte-rendu. Il faut donc réviser TOUS les documents qui ont été envoyés sur ces sujets.<br>
                    
                    Bon courage !
                </div>
            </div>

            <div class="pagination">
                <a href="#"><</a>
                <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">></a>
            </div>




    </main>

</body>
</html>