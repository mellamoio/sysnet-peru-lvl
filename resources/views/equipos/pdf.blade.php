<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ficha Técnica - {{ $equipo->imei }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #333; margin: 0; padding: 20px; }
        .card { border: 2px solid rgba(110, 129, 220, 0.1); border-radius: 8px; padding: 25px; background: #fff; }
        .header { text-align: center; border-bottom: 2px solid #f0f0f0; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { margin: 0; color: #6e81dc; font-size: 24px; text-transform: uppercase; }
        .header p { margin: 5px 0 0; color: #777; font-size: 14px; }
        .content { display: table; width: 100%; margin-bottom: 20px; }
        .column-left { display: table-cell; width: 40%; vertical-align: top; text-align: center; }
        .column-right { display: table-cell; width: 60%; vertical-align: top; padding-left: 20px; }
        .img-box { border: 1px solid #ddd; padding: 10px; border-radius: 6px; }
        .img-box img { max-width: 100%; height: auto; }
        .info-table { width: 100%; border-collapse: collapse; }
        .info-table td { padding: 8px 0; border-bottom: 1px dashed #eee; font-size: 14px; }
        .label { font-weight: bold; color: #555; }
        .badge { display: inline-block; padding: 4px 10px; background: #e8f5e9; color: #6e81dc; border-radius: 4px; font-weight: bold; }
        .footer { text-align: center; margin-top: 30px; font-size: 12px; color: #999; border-top: 1px solid #f0f0f0; padding-top: 10px; }
        .info-table td:last-child{ padding-left: 0.3em }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <h1>FICHA TÉCNICA DE EQUIPO</h1>
            <p>Sistema de Control de Inventario</p>
        </div>

        <div class="content">
            <div class="column-left">
                <div class="img-box">
                    @if($equipo->modelo && $equipo->modelo->url_imagen)
                        <img src="{{ public_path('storage/'.$equipo->modelo->url_imagen) }}">
                    @else
                        <p style="color: #bbb;">Sin Imagen</p>
                    @endif
                </div>
            </div>

            <div class="column-right">
                <table class="info-table">
                    <tr>
                        <td class="label">IMEI:</td>
                        <td>
                            <span class="badge">{{ $equipo->imei }}</span>
                            <div style="margin-top: 0.5rem">
                                {!! DNS1D::getBarcodeHTML($equipo->imei, 'C128', 2, 40) !!}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Tipo de Producto:</td>
                        <td>{{ $equipo->modelo->tipoProducto->nombre ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Marca:</td>
                        <td>{{ $equipo->modelo->marca->nombre ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Modelo:</td>
                        <td>{{ $equipo->modelo->nombre ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Estado:</td>
                        <td>{{ $equipo->estado->nombre ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Disponibilidad:</td>
                        <td>{{ $equipo->disponible ? 'Disponible' : 'No disponible' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        @if($equipo->observaciones)
            <div style="margin-top: 15px; background: #f9f9f9; padding: 12px; border-radius: 4px;">
                <strong class="label">Observaciones:</strong>
                <p style="margin: 5px 0 0; font-size: 13px;">{!! $equipo->observaciones !!}</p>
            </div>
        @endif

        <div class="footer">
            Generado el {{ now()->format('d/m/Y H:i') }}
        </div>
    </div>
</body>
</html>