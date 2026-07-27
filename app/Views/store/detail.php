<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Detalle Producto - Placas Personalizadas</title>

    <!-- ===== CSS ===== -->
    <!-- Bootstrap 3 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <!-- Material Design Iconic Font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" />

    <style>
        /* ============================================================
           ESTILOS COMPLETOS (SCSS convertido a CSS)
           ============================================================ */

        /* ----- Variables de colores ----- */
        .selector-color--item {
            min-width: 30px;
            min-height: 30px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 0.5rem;
            cursor: pointer;
            border: 2px solid #ddd;
            transition: border-color 0.2s;
        }
        .selector-color--item:hover {
            border-color: #e74c3c;
        }

        /* Colores dinámicos */
        .selector-color-1 { background: #065389; }
        .selector-color-2 { background: #1f42a7; }
        .selector-color-3 { background: #000000; }
        .selector-color-4 { background: #ffffff; border-color: #ccc; }
        .selector-color-5 { background: #f79822; }
        .selector-color-6 { background: #ed3125; }
        .selector-color-7 { background: #0b7052; }
        .selector-color-8 { background: #696a6c; }

        .letra-color-1 { color: #065389; }
        .letra-color-2 { color: #1f42a7; }
        .letra-color-3 { color: #000000; }
        .letra-color-4 { color: #ffffff; text-shadow: 0 0 4px rgba(0,0,0,0.3); }
        .letra-color-5 { color: #f79822; }
        .letra-color-6 { color: #ed3125; }
        .letra-color-7 { color: #0b7052; }
        .letra-color-8 { color: #696a6c; }

        /* ----- Layout general ----- */
        #placa {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .placa--img {
            align-self: center;
            width: 100%;
        }

        /* ----- Estilos base para líneas de texto ----- */
        .linea-1, .linea-2, .linea-3 {
            position: absolute;
            z-index: 3;
            text-transform: uppercase;
            font-weight: bold;
            width: 94%;
            padding: 0 2%;
            text-align: center;
            pointer-events: none;
        }
        .linea-1 { top: 10%; }
        .linea-2 { top: 30%; }
        .linea-3 { top: 50%; }

        /* ----- Fuentes ----- */
        .ff-tipo-0 { font-family: 'Arial', sans-serif; }
        .ff-tipo-1 { font-family: 'Times New Roman', serif; }
        .ff-tipo-2 { font-family: 'Courier New', monospace; }
        .ff-tipo-3 { font-family: 'Georgia', serif; }
        .ff-tipo-4 { font-family: 'Impact', fantasy; }

        /* ----- Categoría 1: Bicicleta ----- */
        .categoria-1 .posicion-4 {
            width: 94%;
            z-index: 3;
            position: absolute;
            padding: 0 2%;
            text-align: center;
        }
        .categoria-1 .posicion-4.personaliza-7 {
            top: 34%;
            font-size: 3.5rem;
            letter-spacing: -1px;
        }

        /* ----- Categoría 2: Americana ----- */
        /* Posición 1 */
        .categoria-2 .posicion-1 {
            width: 94%;
            z-index: 3;
            position: absolute;
            padding: 0 2%;
            text-align: center;
        }
        .categoria-2 .posicion-1.personaliza-15 {
            top: 15%;
            font-size: 7.2rem;
        }
        .categoria-2 .posicion-1.personaliza-7 {
            top: 48%;
            font-size: 7rem;
        }
        .categoria-2 .posicion-1.personaliza-11 {
            top: 48%;
            font-size: 7.5rem;
        }

        /* Posición 2 */
        .categoria-2 .posicion-2 {
            width: 94%;
            z-index: 3;
            position: absolute;
            padding: 0 2%;
            text-align: center;
        }
        .categoria-2 .posicion-2.personaliza-15 {
            font-size: 7.5rem;
        }
        .categoria-2 .posicion-2.personaliza-15.linea-1 {
            top: 12%;
        }
        .categoria-2 .posicion-2.personaliza-15.linea-2 {
            top: 34%;
        }
        .categoria-2 .posicion-2.personaliza-15.linea-3 {
            top: 56%;
        }

        /* Posición 3 */
        .categoria-2 .posicion-3 {
            width: 94%;
            z-index: 3;
            position: absolute;
            padding: 0 2%;
            text-align: center;
        }
        .categoria-2 .posicion-3.personaliza-8 {
            font-size: 8.5rem;
        }
        .categoria-2 .posicion-3.personaliza-8.linea-1 {
            top: 18%;
        }
        .categoria-2 .posicion-3.personaliza-8.linea-2 {
            top: 50%;
        }

        /* Posición 4 */
        .categoria-2 .posicion-4 {
            width: 94%;
            z-index: 3;
            position: absolute;
            padding: 0 2%;
            text-align: center;
        }
        .categoria-2 .posicion-4.personaliza-7 {
            top: 38%;
            font-size: 7rem;
        }
        .categoria-2 .posicion-4.personaliza-11 {
            top: 35%;
            font-size: 7rem;
        }

        /* Posición 5 */
        .categoria-2 .posicion-5 {
            width: 94%;
            z-index: 3;
            position: absolute;
            padding: 0 2%;
            text-align: center;
        }
        .categoria-2 .posicion-5.personaliza-7 {
            top: 22%;
            font-size: 7rem;
        }
        .categoria-2 .posicion-5.personaliza-11 {
            top: 21%;
            font-size: 7.5rem;
        }
        .categoria-2 .posicion-5.personaliza-15 {
            top: 53%;
            font-size: 7.2rem;
        }

        /* ----- Categoría 3: Euromini ----- */
        .categoria-3 .posicion-4 {
            width: 94%;
            z-index: 3;
            position: absolute;
            padding: 0 2% 0 12%;
            text-align: center;
        }
        .categoria-3 .posicion-4.ff-tipo-4.personaliza-11 {
            padding: 0 2%;
        }
        .categoria-3 .posicion-4.personaliza-9 {
            top: 14%;
            font-size: 3rem;
        }
        .categoria-3 .posicion-4.personaliza-11 {
            top: 13%;
            font-size: 3.2rem;
        }

        /* ----- Categoría 4: Europea ----- */
        .categoria-4 .posicion-4 {
            width: 94%;
            z-index: 3;
            padding: 0 2% 0 12%;
            position: absolute;
            text-align: center;
        }
        .categoria-4 .posicion-4.ff-tipo-2.personaliza-5 {
            padding: 0 2% 0 21%;
        }
        .categoria-4 .posicion-4.ff-tipo-2.personaliza-8 {
            padding: 0 2%;
        }
        .categoria-4 .posicion-4.ff-tipo-3.personaliza-6 {
            padding: 0 2% 0 21%;
        }
        .categoria-4 .posicion-4.ff-tipo-3.personaliza-10 {
            padding: 0 2%;
            width: 88%;
        }
        .categoria-4 .posicion-4.ff-tipo-4.personaliza-5 {
            padding: 0 2% 0 21%;
        }
        .categoria-4 .posicion-4.ff-tipo-4.personaliza-9 {
            padding: 0 2%;
        }
        .categoria-4 .posicion-4.personaliza-5 {
            top: 30%;
            font-size: 4.5rem;
        }
        .categoria-4 .posicion-4.personaliza-6 {
            top: 30%;
            font-size: 4.5rem;
        }
        .categoria-4 .posicion-4.personaliza-7 {
            top: 25%;
            font-size: 3.5rem;
        }
        .categoria-4 .posicion-4.personaliza-8 {
            top: 20%;
            font-size: 3.4rem;
        }
        .categoria-4 .posicion-4.personaliza-9 {
            top: 19%;
            font-size: 3.8rem;
            letter-spacing: 1px;
        }
        .categoria-4 .posicion-4.personaliza-10 {
            top: 25%;
            font-size: 3.6rem;
        }

        /* ============================================================
           MEDIA QUERIES
           ============================================================ */

        /* ----- Tablet (480px - 768px) ----- */
        @media (min-width: 480px) and (max-width: 768px) {
            .categoria-1 .posicion-4.personaliza-7 {
                top: 40%;
                font-size: 5.5rem;
                letter-spacing: -1px;
            }
            .categoria-2 .posicion-1.personaliza-15 {
                top: 19%;
                font-size: 13rem;
            }
            .categoria-2 .posicion-1.personaliza-7 {
                top: 54%;
                font-size: 11rem;
            }
            .categoria-2 .posicion-1.personaliza-11 {
                top: 55%;
                font-size: 11rem;
            }
            .categoria-2 .posicion-2.personaliza-15 {
                font-size: 12.3rem;
            }
            .categoria-2 .posicion-2.personaliza-15.linea-1 {
                top: 16%;
            }
            .categoria-2 .posicion-2.personaliza-15.linea-2 {
                top: 40%;
            }
            .categoria-2 .posicion-2.personaliza-15.linea-3 {
                top: 63%;
            }
            .categoria-2 .posicion-3.personaliza-8 {
                font-size: 14rem;
            }
            .categoria-2 .posicion-3.personaliza-8.linea-1 {
                top: 21%;
            }
            .categoria-2 .posicion-3.personaliza-8.linea-2 {
                top: 56%;
            }
            .categoria-2 .posicion-4.personaliza-7 {
                top: 45%;
                font-size: 11rem;
            }
            .categoria-2 .posicion-4.personaliza-11 {
                top: 41%;
                font-size: 11rem;
            }
            .categoria-2 .posicion-5.personaliza-7 {
                top: 27%;
                font-size: 11rem;
            }
            .categoria-2 .posicion-5.personaliza-11 {
                top: 25%;
                font-size: 11.8rem;
            }
            .categoria-2 .posicion-5.personaliza-15 {
                top: 60%;
                font-size: 13rem;
            }
            .categoria-3 .posicion-4.ff-tipo-4.personaliza-11 {
                padding: 0 2%;
            }
            .categoria-3 .posicion-4.personaliza-9 {
                top: 22%;
                font-size: 5rem;
            }
            .categoria-3 .posicion-4.personaliza-11 {
                top: 28%;
                font-size: 5.2rem;
            }
            .categoria-4 .posicion-4.ff-tipo-2.personaliza-5 {
                padding: 0 2% 0 21%;
            }
            .categoria-4 .posicion-4.ff-tipo-2.personaliza-8 {
                padding: 0 2%;
            }
            .categoria-4 .posicion-4.ff-tipo-3.personaliza-6 {
                padding: 0 2% 0 21%;
            }
            .categoria-4 .posicion-4.ff-tipo-3.personaliza-10 {
                padding: 0 2%;
                width: 88%;
            }
            .categoria-4 .posicion-4.ff-tipo-4.personaliza-5 {
                padding: 0 2% 0 21%;
            }
            .categoria-4 .posicion-4.ff-tipo-4.personaliza-9 {
                padding: 0 2%;
            }
            .categoria-4 .posicion-4.personaliza-5 {
                top: 38%;
                font-size: 7rem;
            }
            .categoria-4 .posicion-4.personaliza-6 {
                top: 46%;
                font-size: 9.5rem;
            }
            .categoria-4 .posicion-4.personaliza-7 {
                top: 33%;
                font-size: 6rem;
            }
            .categoria-4 .posicion-4.personaliza-8 {
                top: 29%;
                font-size: 6rem;
            }
            .categoria-4 .posicion-4.personaliza-9 {
                top: 27%;
                font-size: 6.0rem;
            }
            .categoria-4 .posicion-4.personaliza-10 {
                top: 32%;
                font-size: 5.0rem;
            }
        }

        /* ----- Tablet grande (768px - 1024px) ----- */
        @media (min-width: 768px) and (max-width: 1024px) {
            .categoria-1 .posicion-4.personaliza-7 {
                top: 42%;
                font-size: 3.6rem;
                letter-spacing: -1px;
            }
            .categoria-2 .posicion-1.personaliza-15 {
                top: 20%;
                font-size: 9rem;
            }
            .categoria-2 .posicion-1.personaliza-7 {
                top: 58%;
                font-size: 7.5rem;
            }
            .categoria-2 .posicion-1.personaliza-11 {
                top: 60%;
                font-size: 7.5rem;
            }
            .categoria-2 .posicion-2.personaliza-15 {
                font-size: 9rem;
            }
            .categoria-2 .posicion-2.personaliza-15.linea-1 {
                top: 16%;
            }
            .categoria-2 .posicion-2.personaliza-15.linea-2 {
                top: 43%;
            }
            .categoria-2 .posicion-2.personaliza-15.linea-3 {
                top: 70%;
            }
            .categoria-2 .posicion-3.personaliza-8 {
                font-size: 9rem;
            }
            .categoria-2 .posicion-3.personaliza-8.linea-1 {
                top: 22%;
            }
            .categoria-2 .posicion-3.personaliza-8.linea-2 {
                top: 62%;
            }
            .categoria-2 .posicion-4.personaliza-7 {
                top: 45%;
                font-size: 8rem;
            }
            .categoria-2 .posicion-4.personaliza-11 {
                top: 43%;
                font-size: 8rem;
            }
            .categoria-2 .posicion-5.personaliza-7 {
                top: 28%;
                font-size: 7.5rem;
            }
            .categoria-2 .posicion-5.personaliza-11 {
                top: 27%;
                font-size: 8rem;
            }
            .categoria-2 .posicion-5.personaliza-15 {
                top: 66%;
                font-size: 9rem;
            }
            .categoria-3 .posicion-4.ff-tipo-4.personaliza-11 {
                padding: 0 2%;
            }
            .categoria-3 .posicion-4.personaliza-9 {
                top: 23%;
                font-size: 3.6rem;
            }
            .categoria-3 .posicion-4.personaliza-11 {
                top: 24%;
                font-size: 3.4rem;
            }
            .categoria-4 .posicion-4.ff-tipo-2.personaliza-5 {
                padding: 0 2% 0 21%;
            }
            .categoria-4 .posicion-4.ff-tipo-2.personaliza-8 {
                padding: 0 2%;
            }
            .categoria-4 .posicion-4.ff-tipo-3.personaliza-6 {
                padding: 0 2% 0 21%;
            }
            .categoria-4 .posicion-4.ff-tipo-3.personaliza-10 {
                padding: 0 2%;
                width: 88%;
            }
            .categoria-4 .posicion-4.ff-tipo-4.personaliza-5 {
                padding: 0 2% 0 21%;
            }
            .categoria-4 .posicion-4.ff-tipo-4.personaliza-9 {
                padding: 0 2%;
            }
            .categoria-4 .posicion-4.personaliza-5 {
                top: 43%;
                font-size: 4.5rem;
            }
            .categoria-4 .posicion-4.personaliza-6 {
                top: 39%;
                font-size: 6.0rem;
            }
            .categoria-4 .posicion-4.personaliza-7 {
                top: 38%;
                font-size: 4rem;
            }
            .categoria-4 .posicion-4.personaliza-8 {
                top: 36%;
                font-size: 4.2rem;
            }
            .categoria-4 .posicion-4.personaliza-9 {
                top: 31%;
                font-size: 4.2rem;
            }
            .categoria-4 .posicion-4.personaliza-10 {
                top: 36%;
                font-size: 4.2rem;
            }
        }

        /* ----- Desktop pequeño (1024px - 1280px) ----- */
        @media (min-width: 1024px) and (max-width: 1280px) {
            .categoria-1 .posicion-4.personaliza-7 {
                top: 44%;
                font-size: 5.0rem;
                letter-spacing: -1px;
            }
            .categoria-2 .posicion-1.personaliza-15 {
                top: 22%;
                font-size: 12rem;
            }
            .categoria-2 .posicion-1.personaliza-7 {
                top: 61%;
                font-size: 10rem;
            }
            .categoria-2 .posicion-1.personaliza-11 {
                top: 62%;
                font-size: 13rem;
            }
            .categoria-2 .posicion-2.personaliza-15 {
                font-size: 11rem;
            }
            .categoria-2 .posicion-2.personaliza-15.linea-1 {
                top: 18%;
            }
            .categoria-2 .posicion-2.personaliza-15.linea-2 {
                top: 45%;
            }
            .categoria-2 .posicion-2.personaliza-15.linea-3 {
                top: 72%;
            }
            .categoria-2 .posicion-3.personaliza-8 {
                font-size: 13.2rem;
            }
            .categoria-2 .posicion-3.personaliza-8.linea-1 {
                top: 24%;
            }
            .categoria-2 .posicion-3.personaliza-8.linea-2 {
                top: 63%;
            }
            .categoria-2 .posicion-4.personaliza-7 {
                top: 48%;
                font-size: 10rem;
            }
            .categoria-2 .posicion-4.personaliza-11 {
                top: 45%;
                font-size: 11rem;
            }
            .categoria-2 .posicion-5.personaliza-7 {
                top: 31%;
                font-size: 10rem;
            }
            .categoria-2 .posicion-5.personaliza-11 {
                top: 28%;
                font-size: 13rem;
            }
            .categoria-2 .posicion-5.personaliza-15 {
                top: 68%;
                font-size: 12rem;
            }
            .categoria-3 .posicion-4.ff-tipo-4.personaliza-11 {
                padding: 0 2%;
            }
            .categoria-3 .posicion-4.personaliza-9 {
                top: 30%;
                font-size: 4.5rem;
            }
            .categoria-3 .posicion-4.personaliza-11 {
                top: 29%;
                font-size: 4.5rem;
            }
            .categoria-4 .posicion-4.ff-tipo-2.personaliza-5 {
                padding: 0 2% 0 21%;
            }
            .categoria-4 .posicion-4.ff-tipo-2.personaliza-8 {
                padding: 0 2%;
            }
            .categoria-4 .posicion-4.ff-tipo-3.personaliza-6 {
                padding: 0 2% 0 21%;
            }
            .categoria-4 .posicion-4.ff-tipo-3.personaliza-10 {
                padding: 0 2%;
                width: 92%;
            }
            .categoria-4 .posicion-4.ff-tipo-4.personaliza-5 {
                padding: 0 2% 0 21%;
            }
            .categoria-4 .posicion-4.ff-tipo-4.personaliza-9 {
                padding: 0 2%;
            }
            .categoria-4 .posicion-4.personaliza-5 {
                top: 46%;
                font-size: 6rem;
            }
            .categoria-4 .posicion-4.personaliza-6 {
                top: 46%;
                font-size: 7.5rem;
            }
            .categoria-4 .posicion-4.personaliza-7 {
                top: 42%;
                font-size: 5rem;
            }
            .categoria-4 .posicion-4.personaliza-8 {
                top: 36%;
                font-size: 5.5rem;
            }
            .categoria-4 .posicion-4.personaliza-9 {
                top: 35%;
                font-size: 5.5rem;
            }
            .categoria-4 .posicion-4.personaliza-10 {
                top: 42%;
                font-size: 5.0rem;
            }
        }

        /* ----- Desktop grande (1280px+) ----- */
        @media (min-width: 1280px) {
            .categoria-1 .posicion-4.personaliza-7 {
                top: 45%;
                font-size: 6.1rem;
                letter-spacing: -1px;
            }
            .categoria-2 .posicion-1.personaliza-15 {
                top: 22%;
                font-size: 14rem;
            }
            .categoria-2 .posicion-1.personaliza-7 {
                top: 62%;
                font-size: 12rem;
            }
            .categoria-2 .posicion-1.personaliza-11 {
                top: 62%;
                font-size: 13rem;
            }
            .categoria-2 .posicion-2.personaliza-15 {
                font-size: 13rem;
            }
            .categoria-2 .posicion-2.personaliza-15.linea-1 {
                top: 19%;
            }
            .categoria-2 .posicion-2.personaliza-15.linea-2 {
                top: 45%;
            }
            .categoria-2 .posicion-2.personaliza-15.linea-3 {
                top: 72%;
            }
            .categoria-2 .posicion-3.personaliza-8 {
                font-size: 15rem;
            }
            .categoria-2 .posicion-3.personaliza-8.linea-1 {
                top: 24%;
            }
            .categoria-2 .posicion-3.personaliza-8.linea-2 {
                top: 65%;
            }
            .categoria-2 .posicion-4.personaliza-7 {
                top: 48%;
                font-size: 12rem;
            }
            .categoria-2 .posicion-4.personaliza-11 {
                top: 46%;
                font-size: 13rem;
            }
            .categoria-2 .posicion-5.personaliza-7 {
                top: 31%;
                font-size: 12rem;
            }
            .categoria-2 .posicion-5.personaliza-11 {
                top: 30%;
                font-size: 13rem;
            }
            .categoria-2 .posicion-5.personaliza-15 {
                top: 69%;
                font-size: 14rem;
            }
            .categoria-3 .posicion-4.ff-tipo-4.personaliza-11 {
                padding: 0 2%;
            }
            .categoria-3 .posicion-4.personaliza-9 {
                top: 34%;
                font-size: 5.5rem;
            }
            .categoria-3 .posicion-4.personaliza-11 {
                top: 34%;
                font-size: 5.3rem;
            }
            .categoria-4 .posicion-4.ff-tipo-2.personaliza-5 {
                padding: 0 2% 0 21%;
            }
            .categoria-4 .posicion-4.ff-tipo-2.personaliza-8 {
                padding: 0 2%;
                letter-spacing: 0.20rem;
            }
            .categoria-4 .posicion-4.ff-tipo-3.personaliza-6 {
                padding: 0 2% 0 21%;
            }
            .categoria-4 .posicion-4.ff-tipo-3.personaliza-10 {
                padding: 0 2%;
                width: 94%;
            }
            .categoria-4 .posicion-4.ff-tipo-4.personaliza-5 {
                padding: 0 2% 0 21%;
            }
            .categoria-4 .posicion-4.ff-tipo-4.personaliza-9 {
                padding: 0 2%;
            }
            .categoria-4 .posicion-4.personaliza-5 {
                top: 46%;
                font-size: 8rem;
            }
            .categoria-4 .posicion-4.personaliza-6 {
                top: 46%;
                font-size: 9.0rem;
                letter-spacing: -7px;
            }
            .categoria-4 .posicion-4.personaliza-7 {
                top: 42%;
                font-size: 6.5rem;
            }
            .categoria-4 .posicion-4.personaliza-8 {
                top: 40%;
                font-size: 6rem;
            }
            .categoria-4 .posicion-4.personaliza-9 {
                top: 40%;
                font-size: 6.5rem;
                letter-spacing: 1.5px;
            }
            .categoria-4 .posicion-4.personaliza-10 {
                top: 44%;
                font-size: 6.0rem;
            }
        }

        /* ============================================================
           OTROS ESTILOS DE LA PÁGINA
           ============================================================ */

        .posicionSeleccionada {
            padding-bottom: 1rem;
            border-bottom: 2px solid #ef3b3d;
        }

        .mb-80 { margin-bottom: 80px; }
        .mb-40 { margin-bottom: 40px; }
        .mb-30 { margin-bottom: 30px; }
        .mb-20 { margin-bottom: 20px; }
        .mb-5 { margin-bottom: 5px; }
        .mt-15 { margin-top: 15px; }
        .mt-30 { margin-top: 30px; }
        .mt-2 { margin-top: 2rem; }
        .ml-20 { margin-left: 20px; }
        .mr-5 { margin-right: 5px; }
        .pb-50 { padding-bottom: 50px; }
        .pb-40 { padding-bottom: 40px; }
        .pb-30 { padding-bottom: 30px; }
        .pt-30 { padding-top: 30px; }
        .f-left { float: left; }
        .clearfix::after { content: ""; display: table; clear: both; }

        .font-700 { font-weight: 700; }
        .font-20px { font-size: 20px; }
        .font-signos { font-size: 12px; color: #666; margin-bottom: 5px; }

        .text-black-1 { color: #111; }
        .text-black-5 { color: #555; }
        .text-danger { color: #a94442; }

        .brand-name-2 { font-size: 14px; color: #888; }
        .new-detail { width: 60px; margin-top: 5px; }

        .widget-title.border-left {
            border-left: 3px solid #e74c3c;
            padding-left: 12px;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
        }

        .selector-color {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-left: 10px;
            padding-top: 4px;
        }

        .sin-pro-color { margin-bottom: 10px; }
        .sin-pro-color .color-title {
            line-height: 30px;
            margin-right: 10px;
        }

        .cart-plus-minus {
            position: relative;
            width: 80px;
            display: inline-block;
        }
        .cart-plus-minus input {
            width: 100%;
            text-align: center;
            border: 1px solid #ddd;
            padding: 6px 0;
            border-radius: 4px;
        }

        .btn-primary {
            background-color: #e74c3c;
            border-color: #c0392b;
            color: #fff;
            padding: 10px 30px;
            border-radius: 30px;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #c0392b;
            border-color: #a93226;
        }

        .font-leyenda-detalle {
            font-size: 12px;
            color: #888;
            background: #f9f9f9;
            padding: 12px;
            border-radius: 6px;
            border-left: 3px solid #e74c3c;
            margin-bottom: 15px;
        }

        .single-product-tab .tab-content {
            background: #fff;
            padding: 20px 0;
        }
        .reviews-tab {
            list-style: none;
            padding: 0;
            margin: 0 0 20px 0;
            border-bottom: 1px solid #eee;
        }
        .reviews-tab li {
            display: inline-block;
            padding: 0 10px;
        }
        .reviews-tab li a {
            color: #555;
            text-decoration: none;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 13px;
            cursor: pointer;
        }
        .reviews-tab li.active a {
            color: #e74c3c;
        }

        .medida-placa img {
            max-width: 100%;
        }

        .charola img {
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            max-width: 100%;
        }

        .pro-rating a { color: #f1c40f; text-decoration: none; }
        .pro-rating a .zmdi-star-outline { color: #ccc; }

        .media { margin-top: 20px; }
        .media-body { overflow: hidden; }
        .name-commenter h6 { margin: 0 0 4px 0; }
        .name-commenter h6 a { color: #333; font-weight: 600; }

        .imgs-zoom-area {
            position: relative;
            width: 100%;
        }
        .placa--img {
            width: 100%;
        }
        .imgs-zoom-area img {
            max-width: 100%;
            display: block;
        }
        .imgs-zoom-area > img[style*="position: absolute"] {
            pointer-events: none;
        }

        .tab-pane {
            display: none;
        }
        .tab-pane.active {
            display: block;
        }

        .posicion-container img {
            max-width: 60px;
            border-radius: 4px;
            border: 2px solid transparent;
            transition: border-color 0.2s;
        }
        .posicion-container img.seleccionada {
            border-color: #e74c3c;
        }

        .opcion-caracteres {
            cursor: pointer;
            border: 2px solid transparent;
            padding: 8px;
            border-radius: 6px;
            transition: border-color 0.2s;
        }
        .opcion-caracteres.seleccionada {
            border-color: #e74c3c;
        }
        .opcion-caracteres img {
            max-width: 100%;
        }
        .opcion-caracteres h6 {
            text-align: center;
            font-weight: 600;
            font-size: 13px;
        }

        @media (max-width: 768px) {
            .col-xs-4 { width: 33.333%; float: left; }
            .col-xs-12 { width: 100%; float: none; }
            .f-left { float: none !important; display: inline-block; }
            .selector-color { margin-left: 0; }
        }
    </style>
</head>
<body>

<div id="app">
    <div class="shop-section mb-80">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="single-product-area mb-80">
                        <div class="row">

                            <!-- ===== COLUMNA IZQUIERDA: PLACA ===== -->
                            <div class="col-md-5 col-sm-5 col-xs-12" id="placa">
                                <div id="textoL1" class="linea-1 ff-tipo-0 posicion-1 personaliza-7 letra-color-1" style="text-transform: uppercase;">Linea 1</div>
                                <div id="textoL2" class="linea-2 ff-tipo-0 posicion-1 personaliza-7 letra-color-1" style="display:none;">Linea 2</div>
                                <div id="textoL3" class="linea-3 ff-tipo-0 posicion-1 personaliza-7 letra-color-1" style="display:none;">Linea 3</div>

                                <div class="imgs-zoom-area" style="position: relative; top:0; left:0;">
                                    <img class="placa--img" id="zoom_03" src="" data-zoom-image="" alt="" style="position: relative; top:0; left:0;" />
                                    <img id="acabadoCordon" style="position: absolute; top:0; left:0; display:none;" src="" />
                                    <img id="acabadoCharolaSC3" style="position: absolute; top:0; left:0; display:none;" src="" />
                                    <img id="acabadoCharolaSC4" style="position: absolute; top:0; left:0; display:none;" src="" />
                                    <img id="acabadoPlano" style="position: absolute; top:0; left:0; display:none;" src="" />
                                </div>
                            </div>

                            <!-- ===== COLUMNA DERECHA ===== -->
                            <div class="col-md-7 col-sm-7 col-xs-12">
                                <div class="single-product-info">
                                    <h2 class="text-black-1 font-700" id="nombreProducto">Cargando...</h2>
                                    <h6 class="brand-name-2" id="claveProducto">-</h6>
                                    <img id="cintilloPromo" src="" class="new-detail" style="display:none;" />
                                </div>
                                <hr />

                                <div class="single-product-tab">
                                    <ul class="reviews-tab mb-40">
                                        <li class="active"><a data-tab="disena">Diseña tu placa</a></li>
                                        <li>|</li>
                                        <li><a data-tab="descrip">Descripción</a></li>
                                        <li>|</li>
                                        <li><a data-tab="ejemplo">Ejemplo</a></li>
                                        <li>|</li>
                                        <li><a data-tab="coments">Reseñas</a></li>
                                    </ul>

                                    <div class="tab-content mb-30">

                                        <!-- TAB DISEÑA -->
                                        <div class="tab-pane active" id="disena" style="overflow-y: scroll; max-height:50vh;">
                                            <div class="col-md-12 text-left posicion-container" id="posicionesContainer"></div>

                                            <div class="col-md-12 posicion clearfix pb-50">
                                                <h6 class="widget-title border-left mb-20">Línea 1:</h6>
                                                <div class="row" id="opcionesL1"></div>
                                                <p class="font-signos" id="signosL1">Símbolos permitidos: ( )</p>
                                                <input type="text" style="width:50% !important; text-transform:uppercase;" maxlength="15" id="inputL1" placeholder="Línea 1" />
                                            </div>

                                            <div class="col-md-12 posicion clearfix pb-50" id="linea2Container">
                                                <h6 class="widget-title border-left mb-20">Línea 2:</h6>
                                                <div class="row" id="opcionesL2"></div>
                                                <p class="font-signos" id="signosL2">Símbolos permitidos: ( )</p>
                                                <input type="text" style="width:50% !important; text-transform:uppercase;" maxlength="15" id="inputL2" placeholder="Línea 2" />
                                            </div>

                                            <div class="col-md-12 posicion clearfix pb-50" id="linea3Container">
                                                <h6 class="widget-title border-left mb-20">Línea 3:</h6>
                                                <div class="row" id="opcionesL3"></div>
                                                <p class="font-signos" id="signosL3">Símbolos permitidos: ( )</p>
                                                <input type="text" style="width:50% !important; text-transform:uppercase;" maxlength="15" id="inputL3" placeholder="Línea 3" />
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <h6 class="widget-title border-left mb-20">Acabados:</h6>
                                                <div class="col-md-6" style="cursor:pointer;" id="acabadoCharola" onclick="cambiaAcabado(2)">
                                                    <img src="" id="acabadoCharolaImg" style="max-width:100%;" />
                                                    <p class="mt-15 ml-20">Tipo Charola</p>
                                                </div>
                                                <div class="col-md-6" style="cursor:pointer;" id="acabadoCordon" onclick="cambiaAcabado(1)">
                                                    <img src="" id="acabadoCordonImg" style="max-width:100%;" />
                                                    <p class="mt-15 ml-20">Tipo Cordón</p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="single-pro-color-rating clearfix pb-40">
                                                    <div class="sin-pro-color f-left">
                                                        <p class="color-title border-left f-left">Color</p>
                                                        <div class="f-left selector-color" id="coloresContainer"></div>
                                                    </div>
                                                    <div class="col-md-6 sin-pro-action f-left ml-20"></div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 plus-minus-pro-action clearfix">
                                                <div class="sin-plus-minus f-left">
                                                    <p class="color-title border-left f-left mr-5">Cantidad</p>
                                                    <div class="cart-plus-minus f-left">
                                                        <input type="number" value="1" name="qtybutton" id="cantidad" class="cart-plus-minus-box" min="1" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-2">
                                                <div class="font-leyenda-detalle">IMPORTANTE: Si utilizas símbolos NO PERMITIDOS, tu pedido NO PODRÁ SER PROCESADO. CONSULTA NUESTRAS POLÍTICAS DE VENTAS PARA CONOCER NUESTRAS RESTRICCIONES.</div>
                                            </div>

                                            <div class="col-md-12 mt-2">
                                                <button class="btn btn-primary" onclick="agregarACarrito()">Agregar al carrito</button>
                                            </div>
                                        </div>

                                        <!-- TAB DESCRIPCIÓN -->
                                        <div class="tab-pane" id="descrip">
                                            <div class="col-md-12 medida-placa mb-40">
                                                <h6 class="widget-title border-left mb-20" id="medidaPlaca">0 x 0 cm.</h6>
                                                <img id="medidaImg" src="" alt="" style="max-width:100%;" />
                                            </div>
                                            <hr />
                                            <div class="col-md-12 mb-40">
                                                <p id="descripcionTexto"></p>
                                                <p><b>TIEMPO DE ENTREGA A MÁS TARDAR 8 DÍAS HÁBILES UNA VEZ QUE HACES TU PEDIDO Y RECIBIMOS TU PAGO.</b></p>
                                            </div>
                                            <div class="col-md-12">
                                                <h6 class="widget-title border-left mb-20">Acabados:</h6>
                                                <div class="charola col-md-6" id="descAcabadoCharola">
                                                    <img src="" style="width:100%;" />
                                                    <p class="mt-15 ml-20">Tipo Charola</p>
                                                </div>
                                                <div class="col-md-6 charola" id="descAcabadoCordon">
                                                    <img src="" style="width:100%;" />
                                                    <p class="mt-15 ml-20">Tipo Cordón</p>
                                                </div>
                                            </div>
                                            <p class="text-danger" style="font-weight:bold;">PLACAS DE USO DECORATIVO, NO SUSTITUYEN PLACAS OFICIALES</p>
                                        </div>

                                        <!-- TAB EJEMPLO -->
                                        <div class="tab-pane" id="ejemplo">
                                            <div class="medida-placa mb-40">
                                                <img class="img-responsive" id="ejemploImg" src="" alt="" style="max-width:100%;" />
                                            </div>
                                        </div>

                                        <!-- TAB RESEÑAS -->
                                        <div class="tab-pane" id="coments">
                                            <div class="col-md-12 medida-placa mb-40">
                                                <div class="post-comments mb-60">
                                                    <h4 class="blog-section-title border-left mb-30">Comentarios de este producto</h4>
                                                    <div id="reseñasContainer"></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
     JAVASCRIPT
     ============================================================ -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-elevatezoom/3.0.8/jquery.elevatezoom.min.js"></script>

<script>
// ============================================================
//  CONFIGURACIÓN
// ============================================================
var CONFIG = {
    API_URL: 'https://api.example.com/',      // CAMBIAR
    DIR_PUBLIC: 'https://ejemplo.com/public/',
    DIR_IMG: 'https://ejemplo.com/img/',
    DIR_FOTOS: 'https://ejemplo.com/fotos/'
};

// ============================================================
//  ESTADO GLOBAL
// ============================================================
var state = {
    datosPlaca: {
        id_producto: null,
        id_categoria: null,
        id_subcategoria: null,
        id_terminado: '',
        nom_producto: '',
        clave: '',
        new: 0,
        ancho: 0,
        largo: 0,
        descripcion: '',
        foto: '',
        ejemplo: '',
        signos: [],
        colores: [],
        posiciones: [],
        resena: []
    },
    acabado: 1,
    textoL1: 'Linea 1',
    textoL2: '',
    textoL3: '',
    posicionActiva: 0,
    opcionesCaracteresL1: [7],
    opcionesCaracteresL2: [],
    opcionesCaracteresL3: [],
    opcionesFuentesL1: [0],
    opcionesFuentesL2: [],
    opcionesFuentesL3: [],
    opcionesAcabado: [1],
    numCaracteresL1: 7,
    numCaracteresL2: 0,
    numCaracteresL3: 0,
    cantidad: 1,
    colorSeleccionado: 1,
    foto: '',
    regex: 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz1234567890\\ ',
    catSignos: '',
    ejemplo: '',
    abreviaCat: 'AME',
    categoriaClase: 'categoria-1'
};

// ============================================================
//  FUNCIONES AUXILIARES
// ============================================================
function getUrlParams() {
    var path = window.location.pathname;
    var parts = path.split('/detalle/');
    return parts.length > 1 ? parts[1] : null;
}

function getAbreviaCat(idCat) {
    var map = { '1':'BIC', '2':'AME', '3':'EURM', '4':'EUR' };
    return map[idCat] || 'AME';
}

function getCategoriaClase(idCat) {
    return 'categoria-' + (idCat || '1');
}

function getClaseL1() {
    return 'ff-tipo-' + (state.opcionesFuentesL1[0] || 0) +
           ' posicion-' + state.posicionActiva +
           ' personaliza-' + state.numCaracteresL1 +
           ' letra-color-' + state.colorSeleccionado +
           ' linea-1';
}

function getClaseL2() {
    if (state.numCaracteresL2 === 0 || !state.opcionesFuentesL2.length) return 'linea-2';
    return 'ff-tipo-' + state.opcionesFuentesL2[0] +
           ' posicion-' + state.posicionActiva +
           ' personaliza-' + state.numCaracteresL2 +
           ' letra-color-' + state.colorSeleccionado +
           ' linea-2';
}

function getClaseL3() {
    if (state.numCaracteresL3 === 0 || !state.opcionesFuentesL3.length) return 'linea-3';
    return 'ff-tipo-' + state.opcionesFuentesL3[0] +
           ' posicion-' + state.posicionActiva +
           ' personaliza-' + state.numCaracteresL3 +
           ' letra-color-' + state.colorSeleccionado +
           ' linea-3';
}

function actualizarClasesTexto() {
    var el1 = document.getElementById('textoL1');
    var el2 = document.getElementById('textoL2');
    var el3 = document.getElementById('textoL3');

    if (el1) {
        el1.className = getClaseL1();
        el1.textContent = state.textoL1.toUpperCase();
    }
    if (el2) {
        if (state.numCaracteresL2 > 0 && state.opcionesCaracteresL2.length) {
            el2.style.display = 'block';
            el2.className = getClaseL2();
            el2.textContent = state.textoL2.toUpperCase();
        } else {
            el2.style.display = 'none';
        }
    }
    if (el3) {
        if (state.numCaracteresL3 > 0 && state.opcionesCaracteresL3.length) {
            el3.style.display = 'block';
            el3.className = getClaseL3();
            el3.textContent = state.textoL3.toUpperCase();
        } else {
            el3.style.display = 'none';
        }
    }
}

// ============================================================
//  FUNCIONES DE RENDERIZADO
// ============================================================

function renderizarPosiciones() {
    var container = document.getElementById('posicionesContainer');
    container.innerHTML = '';
    state.posiciones.forEach(function(pos, index) {
        var img = document.createElement('img');
        img.style.width = '10%';
        img.style.marginRight = '2.5%';
        img.style.cursor = 'pointer';
        img.className = 'mb-5';
        if (pos.id_posicion == state.posicionActiva) img.classList.add('seleccionada');
        img.src = CONFIG.DIR_IMG + 'posiciones/p' + pos.id_posicion + '.jpg';
        img.onclick = (function(i) { return function() { cambiaLayout(i); }; })(index);
        container.appendChild(img);
    });
}

function renderizarOpcionesLinea(linea) {
    var containerId = linea === 1 ? 'opcionesL1' : (linea === 2 ? 'opcionesL2' : 'opcionesL3');
    var container = document.getElementById(containerId);
    if (!container) return;

    var chars = linea === 1 ? state.opcionesCaracteresL1 :
                (linea === 2 ? state.opcionesCaracteresL2 : state.opcionesCaracteresL3);
    var fuentes = linea === 1 ? state.opcionesFuentesL1 :
                  (linea === 2 ? state.opcionesFuentesL2 : state.opcionesFuentesL3);
    var numActual = linea === 1 ? state.numCaracteresL1 :
                    (linea === 2 ? state.numCaracteresL2 : state.numCaracteresL3);

    container.innerHTML = '';
    if (!chars || !chars.length) {
        container.innerHTML = '<p class="text-muted">No disponible</p>';
        return;
    }

    chars.forEach(function(opcion, index) {
        var div = document.createElement('div');
        div.className = 'col-xs-4 opcion-caracteres';
        if (opcion == numActual) div.classList.add('seleccionada');

        var h6 = document.createElement('h6');
        h6.className = 'mb-20';
        h6.textContent = opcion + ' letras';

        var img = document.createElement('img');
        img.className = 'img-responsive';
        var fuente = fuentes[index] || 0;
        var lineaLabel = linea === 1 ? '' : (linea === 2 ? '_L2' : '_L3');
        img.src = CONFIG.DIR_IMG + 'detalles/' + state.abreviaCat + '_' + opcion + 'L_' + fuente + lineaLabel + '.svg';
        img.alt = '';

        div.appendChild(h6);
        div.appendChild(img);
        div.onclick = (function(l, idx) { return function() { cambiaNumCaracteres(l, idx); }; })(linea, index);
        container.appendChild(div);
    });
}

function renderizarColores(colores) {
    var container = document.getElementById('coloresContainer');
    container.innerHTML = '';
    colores.forEach(function(color) {
        var div = document.createElement('div');
        div.className = 'selector-color--item selector-color-' + color.id_color;
        if (color.id_color == state.colorSeleccionado) div.style.borderColor = '#e74c3c';
        div.onclick = function() { cambiaColor(color.id_color); };
        container.appendChild(div);
    });
}

function renderizarResenas(resenas) {
    var container = document.getElementById('reseñasContainer');
    container.innerHTML = '';
    if (!resenas || resenas.length === 0) {
        container.innerHTML = '<p>No hay comentarios para este producto.</p>';
        return;
    }
    resenas.forEach(function(r) {
        var media = document.createElement('div');
        media.className = 'media mt-30';

        var ratingDiv = document.createElement('div');
        ratingDiv.className = 'pro-rating sin-pro-rating mb-20';
        for (var i = 1; i <= 5; i++) {
            var a = document.createElement('a');
            var icon = document.createElement('i');
            icon.className = i <= r.rating ? 'zmdi zmdi-star font-20px' : 'zmdi zmdi-star-outline font-20px';
            a.appendChild(icon);
            ratingDiv.appendChild(a);
        }
        media.appendChild(ratingDiv);

        var body = document.createElement('div');
        body.className = 'media-body';

        var clearfix = document.createElement('div');
        clearfix.className = 'clearfix';

        var nameDiv = document.createElement('div');
        nameDiv.className = 'name-commenter f-left';
        var h6 = document.createElement('h6');
        var link = document.createElement('a');
        link.textContent = (r.nombres || '') + ' ' + (r.paterno || '');
        h6.appendChild(link);
        var p = document.createElement('p');
        p.className = 'mb-10';
        p.textContent = r.fecha_add || '';
        nameDiv.appendChild(h6);
        nameDiv.appendChild(p);
        clearfix.appendChild(nameDiv);
        body.appendChild(clearfix);

        var descP = document.createElement('p');
        descP.className = 'mb-0';
        descP.textContent = r.descripcion || '';
        body.appendChild(descP);

        media.appendChild(body);
        container.appendChild(media);
    });
}

// ============================================================
//  FUNCIONES DE ACCIÓN
// ============================================================

function cambiaLayout(seleccion) {
    var pos = state.posiciones[seleccion];
    if (!pos) return;

    state.posicionActiva = pos.id_posicion;
    state.opcionesCaracteresL1 = pos.caracteres_linea_1 ? pos.caracteres_linea_1.split(',') : [7];
    state.opcionesFuentesL1 = pos.id_fuente_linea_1 ? pos.id_fuente_linea_1.split(',') : [0];

    if (pos.caracteres_linea_2) {
        state.opcionesCaracteresL2 = pos.caracteres_linea_2.split(',');
        state.opcionesFuentesL2 = pos.id_fuente_linea_2.split(',');
        document.getElementById('linea2Container').style.display = 'block';
    } else {
        state.opcionesCaracteresL2 = [];
        state.opcionesFuentesL2 = [];
        document.getElementById('linea2Container').style.display = 'none';
    }

    if (pos.caracteres_linea_3) {
        state.opcionesCaracteresL3 = pos.caracteres_linea_3.split(',');
        state.opcionesFuentesL3 = pos.id_fuente_linea_3.split(',');
        document.getElementById('linea3Container').style.display = 'block';
    } else {
        state.opcionesCaracteresL3 = [];
        state.opcionesFuentesL3 = [];
        document.getElementById('linea3Container').style.display = 'none';
    }

    state.numCaracteresL1 = state.opcionesCaracteresL1[0] || 7;
    state.numCaracteresL2 = state.opcionesCaracteresL2.length ? state.opcionesCaracteresL2[0] : 0;
    state.numCaracteresL3 = state.opcionesCaracteresL3.length ? state.opcionesCaracteresL3[0] : 0;

    // Actualizar inputs
    document.getElementById('inputL1').maxLength = state.numCaracteresL1;
    if (state.textoL1.length > state.numCaracteresL1) {
        state.textoL1 = state.textoL1.substring(0, state.numCaracteresL1);
        document.getElementById('inputL1').value = state.textoL1;
    }

    if (state.numCaracteresL2 > 0) {
        document.getElementById('inputL2').maxLength = state.numCaracteresL2;
        if (state.textoL2.length > state.numCaracteresL2) {
            state.textoL2 = state.textoL2.substring(0, state.numCaracteresL2);
            document.getElementById('inputL2').value = state.textoL2;
        }
    }

    if (state.numCaracteresL3 > 0) {
        document.getElementById('inputL3').maxLength = state.numCaracteresL3;
        if (state.textoL3.length > state.numCaracteresL3) {
            state.textoL3 = state.textoL3.substring(0, state.numCaracteresL3);
            document.getElementById('inputL3').value = state.textoL3;
        }
    }

    renderizarOpcionesLinea(1);
    if (state.opcionesCaracteresL2.length) renderizarOpcionesLinea(2);
    if (state.opcionesCaracteresL3.length) renderizarOpcionesLinea(3);

    renderizarPosiciones();
    actualizarClasesTexto();
    actualizarCategoria();
}

function cambiaNumCaracteres(linea, seleccion) {
    if (linea === 1) {
        state.numCaracteresL1 = parseInt(state.opcionesCaracteresL1[seleccion]);
        state.opcionesFuentesL1 = [state.opcionesFuentesL1[seleccion]];
        document.getElementById('inputL1').maxLength = state.numCaracteresL1;
        if (state.textoL1.length > state.numCaracteresL1) {
            state.textoL1 = state.textoL1.substring(0, state.numCaracteresL1);
            document.getElementById('inputL1').value = state.textoL1;
        }
        renderizarOpcionesLinea(1);
    } else if (linea === 2) {
        state.numCaracteresL2 = parseInt(state.opcionesCaracteresL2[seleccion]);
        state.opcionesFuentesL2 = [state.opcionesFuentesL2[seleccion]];
        document.getElementById('inputL2').maxLength = state.numCaracteresL2;
        if (state.textoL2.length > state.numCaracteresL2) {
            state.textoL2 = state.textoL2.substring(0, state.numCaracteresL2);
            document.getElementById('inputL2').value = state.textoL2;
        }
        renderizarOpcionesLinea(2);
    } else if (linea === 3) {
        state.numCaracteresL3 = parseInt(state.opcionesCaracteresL3[seleccion]);
        state.opcionesFuentesL3 = [state.opcionesFuentesL3[seleccion]];
        document.getElementById('inputL3').maxLength = state.numCaracteresL3;
        if (state.textoL3.length > state.numCaracteresL3) {
            state.textoL3 = state.textoL3.substring(0, state.numCaracteresL3);
            document.getElementById('inputL3').value = state.textoL3;
        }
        renderizarOpcionesLinea(3);
    }
    actualizarClasesTexto();
}

function cambiaColor(seleccion) {
    state.colorSeleccionado = seleccion;
    actualizarClasesTexto();
    renderizarColores(state.datosPlaca.colores || []);
}

function cambiaAcabado(seleccion) {
    state.acabado = seleccion;
    actualizarFoto();
    renderizarAcabados();
}

function actualizarFoto() {
    var p = state.datosPlaca;
    var cat = p.id_categoria || 0;
    var subcat = p.id_subcategoria || 0;

    var fotoPlaca = document.getElementById('zoom_03');

    if (state.acabado == 1) {
        state.foto = CONFIG.DIR_FOTOS + subcat + '/' + p.foto;
    } else {
        var parts = p.foto.split('.');
        state.foto = CONFIG.DIR_FOTOS + subcat + '/' + parts[0] + 'ch.' + parts[1];
    }
    fotoPlaca.src = state.foto;
    fotoPlaca.dataset.zoomImage = state.foto;

    // Acabados overlay
    var cordon = document.getElementById('acabadoCordon');
    var charolaSC3 = document.getElementById('acabadoCharolaSC3');
    var charolaSC4 = document.getElementById('acabadoCharolaSC4');
    var plano = document.getElementById('acabadoPlano');

    cordon.style.display = 'none';
    charolaSC3.style.display = 'none';
    charolaSC4.style.display = 'none';
    plano.style.display = 'none';

    if (state.acabado == 1) {
        cordon.style.display = 'block';
        cordon.src = CONFIG.DIR_PUBLIC + 'acabado/' + cat + '/acabado-' + state.colorSeleccionado + '.png';
    } else if (state.acabado == 2 && subcat == 3) {
        charolaSC3.style.display = 'block';
        charolaSC3.src = CONFIG.DIR_PUBLIC + 'acabado/' + cat + '/acabado-ch-' + p.id_producto + '.png';
    } else if (state.acabado == 2 && (subcat == 4 || subcat == 5)) {
        charolaSC4.style.display = 'block';
        charolaSC4.src = CONFIG.DIR_PUBLIC + 'acabado/' + cat + '/acabado-ch.png';
    } else {
        plano.style.display = 'block';
        plano.src = CONFIG.DIR_PUBLIC + 'acabado/' + cat + '/acabado-pl.png';
    }

    // Recalcular zoom
    if ($.fn.elevateZoom) {
        try {
            $('#zoom_03').data('zoom-image', state.foto).elevateZoom({
                responsive: true,
                zoomType: 'lens',
                containLensZoom: true
            });
        } catch(e) {}
    }
}

function renderizarAcabados() {
    var cat = state.datosPlaca.id_categoria || 0;
    var charolaDiv = document.getElementById('acabadoCharola');
    var cordonDiv = document.getElementById('acabadoCordon');

    if (state.opcionesAcabado.includes(2)) {
        charolaDiv.style.display = 'block';
        document.getElementById('acabadoCharolaImg').src = CONFIG.DIR_IMG + 'acabado/' + cat + '/acabado_charola_th.png';
        charolaDiv.classList.toggle('posicionSeleccionada', state.acabado == 2);
    } else {
        charolaDiv.style.display = 'none';
    }

    if (state.opcionesAcabado.includes(1)) {
        cordonDiv.style.display = 'block';
        document.getElementById('acabadoCordonImg').src = CONFIG.DIR_IMG + 'acabado/' + cat + '/acabado_cordon_th.png';
        cordonDiv.classList.toggle('posicionSeleccionada', state.acabado == 1);
    } else {
        cordonDiv.style.display = 'none';
    }

    // Descripción
    var descCharola = document.getElementById('descAcabadoCharola');
    var descCordon = document.getElementById('descAcabadoCordon');
    if (state.opcionesAcabado.includes(2)) {
        descCharola.style.display = 'block';
        descCharola.querySelector('img').src = CONFIG.DIR_IMG + 'acabado/' + cat + '/acabado_charola.png';
    } else {
        descCharola.style.display = 'none';
    }
    if (state.opcionesAcabado.includes(1)) {
        descCordon.style.display = 'block';
        descCordon.querySelector('img').src = CONFIG.DIR_IMG + 'acabado/' + cat + '/acabado_cordon.png';
    } else {
        descCordon.style.display = 'none';
    }
}

function actualizarCategoria() {
    var placa = document.getElementById('placa');
    var catClase = getCategoriaClase(state.datosPlaca.id_categoria);
    // Remover clases categoria-* existentes
    placa.className = placa.className.replace(/categoria-\d+/g, '').trim();
    placa.classList.add(catClase);
    state.categoriaClase = catClase;
}

function actualizarTextoPlaca() {
    state.textoL1 = document.getElementById('inputL1').value || '';
    state.textoL2 = document.getElementById('inputL2').value || '';
    state.textoL3 = document.getElementById('inputL3').value || '';
    actualizarClasesTexto();
}

// ============================================================
//  CARGA DE PRODUCTO
// ============================================================
function cargarProducto(idPlaca) {
    fetch(CONFIG.API_URL + 'tienda/detalles_producto/' + idPlaca)
        .then(function(response) { return response.json(); })
        .then(function(res) {
            if (res.Code === 200) {
                state.datosPlaca = res.Producto || res;
                renderizarProducto();
            } else {
                alert('Error: ' + (res.Msg || 'Producto no encontrado'));
            }
        })
        .catch(function(err) {
            console.error(err);
            alert('Error al cargar el producto');
        });
}

function renderizarProducto() {
    var p = state.datosPlaca;
    state.abreviaCat = getAbreviaCat(p.id_categoria);
    state.categoriaClase = getCategoriaClase(p.id_categoria);

    document.getElementById('nombreProducto').textContent = p.nom_producto || '';
    document.getElementById('claveProducto').textContent = p.clave || '';

    var promo = document.getElementById('cintilloPromo');
    if (p.new == 1) {
        promo.style.display = 'block';
        promo.src = CONFIG.DIR_IMG + 'cintillo_promo.svg';
    } else {
        promo.style.display = 'none';
    }

    state.posiciones = p.posiciones || [];
    renderizarPosiciones();

    state.opcionesAcabado = (p.id_terminado || '').split(',').map(Number);
    renderizarAcabados();

    renderizarColores(p.colores || []);

    state.ejemplo = CONFIG.DIR_FOTOS + (p.id_subcategoria || '') + '/' + (p.ejemplo || '');
    document.getElementById('ejemploImg').src = state.ejemplo;

    document.getElementById('medidaPlaca').textContent = (p.ancho || 0) + ' x ' + (p.largo || 0) + ' cm.';
    var medidaImg = document.getElementById('medidaImg');
    if (p.id_producto == 84) {
        medidaImg.src = CONFIG.DIR_IMG + 'detalles/medida_sn_marino.png';
    } else if (p.id_producto == 85) {
        medidaImg.src = CONFIG.DIR_IMG + 'detalles/medida_turquia.png';
    } else {
        medidaImg.src = CONFIG.DIR_IMG + 'detalles/medida_' + state.abreviaCat.toLowerCase() + '.png';
    }

    document.getElementById('descripcionTexto').textContent = p.descripcion || '';

    renderizarResenas(p.resena || []);

    // Signos
    var arregloSimbolos = p.signos || [];
    var regex = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz1234567890\\ ';
    var catSignos = '';
    arregloSimbolos.forEach(function(signo) {
        var simbolo = '', simbolo_show = '';
        switch (signo) {
            case '1': simbolo = '\\-'; simbolo_show = '\\-'; break;
            case '2': simbolo = '.'; simbolo_show = '.'; break;
            case '3': simbolo = ','; simbolo_show = ','; break;
            case '4': simbolo = "'"; simbolo_show = "'"; break;
            case '5': simbolo = '¨äÄëËïÏöÖüÜ'; simbolo_show = '¨ÄËÏÖÜ'; break;
        }
        regex += simbolo;
        catSignos += ' ' + simbolo_show.replace(/\\/g, '');
    });
    state.regex = regex;
    state.catSignos = catSignos;

    document.getElementById('signosL1').textContent = 'Símbolos permitidos: ( ' + catSignos + ' )';
    document.getElementById('signosL2').textContent = 'Símbolos permitidos: ( ' + catSignos + ' )';
    document.getElementById('signosL3').textContent = 'Símbolos permitidos: ( ' + catSignos + ' )';

    // Configurar inputs
    document.getElementById('inputL1').maxLength = state.numCaracteresL1;
    if (state.numCaracteresL2 > 0) document.getElementById('inputL2').maxLength = state.numCaracteresL2;
    if (state.numCaracteresL3 > 0) document.getElementById('inputL3').maxLength = state.numCaracteresL3;

    state.acabado = state.opcionesAcabado[0] || 1;
    actualizarFoto();

    cambiaLayout(0);
    actualizarCategoria();

    // Zoom
    setTimeout(function() {
        if ($.fn.elevateZoom) {
            try {
                $('#zoom_03').data('zoom-image', state.foto).elevateZoom({
                    responsive: true,
                    zoomType: 'lens',
                    containLensZoom: true
                });
            } catch(e) {}
        }
    }, 500);
}

// ============================================================
//  EVENTOS Y FUNCIONES GLOBALES
// ============================================================

function checaRegex(evento) {
    var key = evento.key;
    if (key === 'Backspace' || key === 'Tab' || key === 'ArrowLeft' || key === 'ArrowRight' ||
        key === 'Delete' || key === 'Home' || key === 'End') {
        return;
    }
    if (!state.regex.includes(key)) {
        evento.preventDefault();
    }
}

function agregarACarrito() {
    var producto = {
        id_producto: state.datosPlaca.id_producto,
        nom_producto: state.datosPlaca.nom_producto,
        cantidad: parseInt(document.getElementById('cantidad').value) || 1,
        personalizacion: {
            posicion: state.posicionActiva,
            linea1: { texto: state.textoL1.toUpperCase(), fuente: state.opcionesFuentesL1[0], caracteres: state.numCaracteresL1 },
            linea2: { texto: state.textoL2.toUpperCase(), fuente: state.opcionesFuentesL2[0] || 0, caracteres: state.numCaracteresL2 },
            linea3: { texto: state.textoL3.toUpperCase(), fuente: state.opcionesFuentesL3[0] || 0, caracteres: state.numCaracteresL3 },
            color: state.colorSeleccionado,
            acabado: state.acabado
        }
    };
    console.log('Agregando al carrito:', producto);
    alert('Producto agregado al carrito!\n' + JSON.stringify(producto, null, 2));

    var url_categoria = '';
    switch (state.datosPlaca.id_categoria) {
        case 1: url_categoria = 'bicicleta'; break;
        case 2: url_categoria = 'americana'; break;
        case 3: url_categoria = 'euromini'; break;
        case 4: url_categoria = 'europea'; break;
        default: url_categoria = 'accesorios'; break;
    }
    setTimeout(function() {
        window.location.href = '/placas/' + url_categoria;
    }, 3000);
}

// ============================================================
//  INICIALIZACIÓN
// ============================================================

document.addEventListener('DOMContentLoaded', function() {
    var idPlaca = getUrlParams();
    if (idPlaca) {
        cargarProducto(idPlaca);
    } else {
        alert('No se especificó un producto');
    }

    // Tabs
    document.querySelectorAll('.reviews-tab a').forEach(function(tab) {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            var target = this.dataset.tab;
            document.querySelectorAll('.reviews-tab li').forEach(function(li) {
                li.classList.remove('active');
            });
            this.parentElement.classList.add('active');

            document.querySelectorAll('.tab-pane').forEach(function(pane) {
                pane.classList.remove('active');
            });
            var targetPane = document.getElementById(target);
            if (targetPane) targetPane.classList.add('active');
        });
    });

    // Inputs
    var inputL1 = document.getElementById('inputL1');
    var inputL2 = document.getElementById('inputL2');
    var inputL3 = document.getElementById('inputL3');

    function onInputChange() {
        state.textoL1 = inputL1.value || '';
        state.textoL2 = inputL2.value || '';
        state.textoL3 = inputL3.value || '';
        actualizarClasesTexto();
    }

    inputL1.addEventListener('input', onInputChange);
    inputL2.addEventListener('input', onInputChange);
    inputL3.addEventListener('input', onInputChange);

    inputL1.addEventListener('keydown', checaRegex);
    inputL2.addEventListener('keydown', checaRegex);
    inputL3.addEventListener('keydown', checaRegex);

    // Prevenir paste
    [inputL1, inputL2, inputL3].forEach(function(inp) {
        inp.addEventListener('paste', function(e) { e.preventDefault(); });
    });

    // Cantidad
    document.getElementById('cantidad').addEventListener('change', function() {
        state.cantidad = parseInt(this.value) || 1;
        if (state.cantidad < 1) state.cantidad = 1;
        this.value = state.cantidad;
    });
});

// Exponer funciones globales
window.cambiaLayout = cambiaLayout;
window.cambiaNumCaracteres = cambiaNumCaracteres;
window.cambiaColor = cambiaColor;
window.cambiaAcabado = cambiaAcabado;
window.agregarACarrito = agregarACarrito;
window.checaRegex = checaRegex;
window.cargarProducto = cargarProducto;
</script>

</body>
</html>