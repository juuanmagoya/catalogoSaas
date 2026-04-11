<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>QR {{ $tenant->name }} · Menú Digital</title>

<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    background: linear-gradient(135deg, #f5f7fa 0%, #e9edf2 100%);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0;
    padding: 20px;
  }

  /* Contenedor principal */
  .wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 28px;
  }

  /* Poster / Tarjeta principal */
  .poster {
    width: 380px;
    max-width: 90vw;
    background: #ffffff;
    border-radius: 48px 32px 48px 32px;
    box-shadow: 0 25px 45px -12px rgba(0, 0, 0, 0.25), 0 4px 12px rgba(0, 0, 0, 0.05);
    text-align: center;
    padding: 32px 24px 36px 24px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    border: 1px solid rgba(255, 255, 255, 0.5);
    position: relative;
    overflow: hidden;
  }

  /* Sutíl borde decorativo superior */
  .poster::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #D4AF37, #C7A252, #D4AF37);
  }

  /* Nombre del negocio con color elegante */
  .business {
    font-size: 28px;
    font-weight: 800;
    letter-spacing: -0.3px;
    background: linear-gradient(135deg, #2c3e50 0%, #1a2a3a 100%);
    background-clip: text;
    -webkit-background-clip: text;
    color: transparent;
    margin-bottom: 12px;
    word-break: break-word;
    padding: 0 8px;
  }

  /* Texto "Escanea" con acento en dorado/cobre suave */
  .scan {
    font-size: 17px;
    font-weight: 600;
    color: #b8860b;
    background: linear-gradient(135deg, #fff9e6, #fff5e0);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 20px;
    border-radius: 60px;
    margin-bottom: 28px;
    letter-spacing: -0.2px;
    box-shadow: 0 2px 6px rgba(184, 134, 11, 0.08);
    border: 1px solid rgba(184, 134, 11, 0.2);
  }

  /* Contenedor QR con borde suave */
  .qr {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 12px 0 8px 0;
    background: white;
    padding: 12px;
    border-radius: 28px;
    box-shadow: 0 12px 22px -10px rgba(0, 0, 0, 0.1);
    border: 1px solid #f0e6d2;
  }

  .qr svg {
    width: 200px;
    height: 200px;
    display: block;
    border-radius: 20px;
    transition: all 0.2s;
  }

  /* URL con color suave en el borde */
  .url {
    margin-top: 22px;
    font-size: 13px;
    font-family: 'SF Mono', 'Fira Code', monospace;
    background: #fefcf8;
    padding: 12px 14px;
    border-radius: 48px;
    color: #4a5568;
    word-break: break-all;
    text-decoration: none;
    letter-spacing: -0.2px;
    border: 1px solid #e8dcc8;
    font-weight: 500;
    transition: all 0.2s;
  }

  /* Botón impresión con acento en dorado */
  .print-btn {
    background: linear-gradient(135deg, #2c3e50, #1e2a36);
    border: none;
    padding: 12px 28px;
    font-size: 16px;
    font-weight: 600;
    font-family: inherit;
    color: white;
    border-radius: 60px;
    cursor: pointer;
    transition: all 0.25s ease;
    box-shadow: 0 4px 12px rgba(44, 62, 80, 0.25);
    display: inline-flex;
    align-items: center;
    gap: 10px;
    letter-spacing: 0.3px;
  }

  .print-btn:hover {
    background: linear-gradient(135deg, #b8860b, #9a7209);
    transform: translateY(-2px);
    box-shadow: 0 12px 20px -12px rgba(184, 134, 11, 0.4);
  }

  .print-btn:active {
    transform: translateY(1px);
  }

  /* Decoración sutil */
  .poster::before {
    content: "✦";
    font-size: 20px;
    color: #d4af37;
    display: block;
    margin-bottom: -8px;
    opacity: 0.5;
    letter-spacing: 4px;
  }

  /* Pequeño detalle de color en el borde del wrapper */
  .wrapper {
    position: relative;
  }

  /* ESTILOS PARA IMPRESIÓN */
  @media print {
    body {
      background: white;
      padding: 0;
      margin: 0;
    }

    .poster {
      box-shadow: none;
      border: 1px solid #ccc;
      border-radius: 24px;
      width: 340px;
      margin: 20px auto;
      page-break-inside: avoid;
    }

    .poster::after {
      background: #aaa;
    }

    .poster::before {
      color: #999;
    }

    .business {
      background: none;
      color: black;
      -webkit-text-fill-color: black;
    }

    .scan {
      background: #f5f5f5;
      color: #333;
      border: 1px solid #ddd;
    }

    .qr svg {
      width: 180px;
      height: 180px;
    }

    .print-btn {
      display: none;
    }

    .url {
      border: 1px solid #ddd;
      background: white;
      color: #111;
    }
  }

  /* responsive */
  @media (max-width: 480px) {
    .poster {
      width: 94vw;
      padding: 26px 18px 32px;
    }
    .business {
      font-size: 24px;
    }
    .qr svg {
      width: 170px;
      height: 170px;
    }
  }
</style>
</head>
<body>
<div class="wrapper">
  <div class="poster">
    <div class="business">{{ $tenant->name }}</div>
    <div class="scan">
      <span>📱</span> Escanea el QR para ver el menú
    </div>
    <div class="qr">{!! $qrCode !!}</div>
    <div class="url">{{ $url }}</div>
  </div>
  <button onclick="window.print();" class="print-btn">
    🖨️ Imprimir cartel
  </button>
</div>
</body>
</html>