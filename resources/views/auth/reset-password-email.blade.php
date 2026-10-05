<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Restablecer Contraseña</title>
</head>
<body style="margin:0;padding:0;background-color:#0E1A24;font-family:Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#0E1A24;padding:40px 16px;">
    <tr>
        <td align="center">
            <table width="580" cellpadding="0" cellspacing="0" border="0" style="max-width:580px;width:100%;">

                <!-- HEADER -->
                <tr>
                    <td style="background-color:#0A121B;border-radius:16px 16px 0 0;padding:32px 40px;text-align:center;border:1px solid #1E333F;border-bottom:none;">
                        <table cellpadding="0" cellspacing="0" border="0" style="margin:0 auto;">
                            <tr>
                                <td style="vertical-align:middle;padding-right:12px;">
                                    <div style="width:48px;height:48px;background-color:#15252F;border:2px solid #F2B33D;border-radius:12px;text-align:center;line-height:44px;font-size:22px;">
                                    🛡️
                                    </div>
                                </td>
                                <td style="vertical-align:middle;text-align:left;">
                                    <div style="font-size:20px;font-weight:700;color:#E8EEF0;letter-spacing:0.5px;">ForenseBox</div>
                                    <div style="font-size:11px;color:#9FB0B8;text-transform:uppercase;letter-spacing:2px;margin-top:2px;">Digital Forensics · Ciberseguridad</div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- LÍNEA ÁMBAR -->
                <tr>
                    <td style="background-color:#F2B33D;height:3px;font-size:0;line-height:0;">&nbsp;</td>
                </tr>

                <!-- CUERPO -->
                <tr>
                    <td style="background-color:#15252F;padding:40px 40px 32px;border-left:1px solid #1E333F;border-right:1px solid #1E333F;">

                        <!-- Icono central -->
                        <table cellpadding="0" cellspacing="0" border="0" style="margin:0 auto 28px;">
                            <tr>
                                <td style="width:72px;height:72px;background-color:rgba(142,123,255,0.14);border:2px solid #8E7BFF;border-radius:36px;text-align:center;vertical-align:middle;font-size:28px;">
                                🔐
                                </td>
                            </tr>
                        </table>

                        <!-- Saludo -->
                        <p style="font-size:22px;font-weight:700;color:#E8EEF0;margin:0 0 12px 0;">Hola, {{ $name }} 👋</p>

                        <!-- Texto principal -->
                        <p style="font-size:15px;color:#9FB0B8;line-height:1.7;margin:0 0 28px 0;">
                            Recibimos una solicitud para <strong style="color:#E8EEF0;font-weight:600;">restablecer la contraseña</strong>
                            de tu cuenta en ForenseBox. Si fuiste tú, haz clic en el botón de abajo para continuar:
                        </p>

                        <!-- Botón -->
                        <table cellpadding="0" cellspacing="0" border="0" style="margin:0 auto 32px;">
                            <tr>
                                <td style="background-color:#F2B33D;border-radius:10px;text-align:center;">
                                    <a href="{{ $url }}"
                                        style="display:inline-block;padding:16px 40px;font-size:16px;font-weight:700;color:#1A1203;text-decoration:none;letter-spacing:0.3px;">
                                        🔑 &nbsp; Restablecer mi Contraseña
                                    </a>
                                </td>
                            </tr>
                        </table>

                        <!-- Caja de expiración -->
                        <table cellpadding="0" cellspacing="0" border="0" width="100%" style="margin-bottom:20px;">
                            <tr>
                                <td style="background-color:#2A2108;border:1px solid #F2B33D;border-radius:10px;padding:14px 18px;">
                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                        <tr>
                                            <td style="font-size:18px;vertical-align:top;padding-right:12px;width:24px;">⏱️</td>
                                            <td style="font-size:13px;color:#F2B33D;line-height:1.6;">
                                                <strong>Este enlace expira en {{ $expire }} minutos.</strong><br>
                                                <span style="color:#9FB0B8;">Si no completas el proceso a tiempo, deberás solicitar uno nuevo desde la página de inicio de sesión.</span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <!-- Caja no solicitaste -->
                        <table cellpadding="0" cellspacing="0" border="0" width="100%" style="margin-bottom:28px;">
                            <tr>
                                <td style="background-color:#0A121B;border:1px solid #1E333F;border-radius:10px;padding:14px 18px;font-size:13px;color:#9FB0B8;line-height:1.6;">
                                🛡️ &nbsp;<strong style="color:#E8EEF0;">¿No solicitaste este cambio?</strong>
                                No hay problema — puedes ignorar este correo con total seguridad. Tu contraseña no cambiará.
                                </td>
                            </tr>
                        </table>

                        <!-- Divider -->
                        <table cellpadding="0" cellspacing="0" border="0" width="100%" style="margin-bottom:20px;">
                            <tr>
                                <td style="border-top:1px solid #27404E;font-size:0;line-height:0;">&nbsp;</td>
                            </tr>
                        </table>

                        <!-- URL fallback -->
                        <p style="font-size:12px;color:#9FB0B8;line-height:1.6;margin:0;">
                            Si el botón no funciona, copia y pega este enlace en tu navegador:<br>
                            <a href="{{ $url }}" style="color:#8E7BFF;word-break:break-all;">{{ $url }}</a>
                        </p>

                    </td>
                </tr>

                <!-- FOOTER -->
                <tr>
                    <td style="background-color:#0A121B;border-radius:0 0 16px 16px;padding:24px 40px;text-align:center;border:1px solid #1E333F;border-top:none;">
                        <p style="font-size:12px;color:#9FB0B8;line-height:1.7;margin:0;">
                        © {{ date('Y') }} ForenseBox · Colombia<br>
                        Este correo fue enviado automáticamente, por favor no respondas a este mensaje.<br>
                        <a href="{{ url('/') }}" style="color:#9FB0B8;text-decoration:none;">forensebox.com</a>
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>
