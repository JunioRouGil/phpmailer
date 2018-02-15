<?php

require_once("phpmailer/PHPMailerAutoload.php");

$mail = new PHPMailer();
 
// DEFINIÇÃO DOS DADOS DE AUTENTICAÇÃO
$mail->IsSMTP(); // Define que a mensagem será SMTP
$mail->Host        = "ssl://smtp.gmail.com"; // Seu endereço de host SMTP
$mail->SMTPDebug   = false; // false ou 1 ou 2
$mail->SMTPAuth    = true; // Define que será utilizada a autenticação -  Mantenha o valor "true"
$mail->Port        = 465; // Porta de comunicação SMTP - Mantenha o valor "465 para gmail ou 587 para outros"
$mail->SMTPSecure  = false; // Define se é utilizado SSL/TLS - Mantenha o valor "false"
$mail->SMTPAutoTLS = false; // Define se, por padrão, será utilizado TLS - Mantenha o valor "false"
$mail->Username    = 'dominio@gmail.com'; // Conta de email existente e ativa para enviar o e-mail
$mail->Password    = 'senhaXPTO'; // Senha da conta de email
 
// DADOS DO REMETENTE
$mail->Sender   = "naoresponda@dominio.com.br"; // Mesma conta de email declarada acima [!not work]
$mail->From     = "naoresponda@dominio.com.br"; // Conta de email que aparece como remetente da msg [!not work]
$mail->FromName = "Correio Eletrônico"; // Nome do contato que está enviando o email
 
// DADOS DO DESTINATÁRIO
$mail->AddAddress('atendimento@dominio.com.br', 'Empresa'); // Define qual conta receberá a msg
//$mail->AddAddress('recebedor2@dominio.com.br'); // Define qual conta de email receberá a mensagem
//$mail->AddBCC('tester@gmail.com', 'Gil'); // Define qual conta de email receberá uma cópia oculta
//$mail->AddCC('copiaoculta@dominio.info'); // Define qual conta de email receberá uma cópia 
 
// Definição de HTML/codificação
$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
 
// DEFINIÇÃO DA MENSAGEM
$mail->Subject  = "[Importante] - Contato Site Empresa"; // Assunto da mensagem
$mail->Body    .= "Oi, tudo bem?<br><br>";
$mail->Body    .= "O visitante <strong>".$_POST['nome']."</strong> entrou em contato conosco pelo site e mandou a seguinte mensagem:<br>";
$mail->Body    .= nl2br($_POST['mensagem'])."<br>"; // Texto da mensagem

$mail->Body    .= " <br><hr><br><h2>Formulário Completo</h2><br><strong>Nome:</strong> ".$_POST['nome']."<br>"; // Texto da mensagem
$mail->Body    .= " <strong>E-mail:</strong> ".$_POST['email']."<br>"; // Texto da mensagem
$mail->Body    .= " <strong>Telefone:</strong> ".$_POST['telefone']."<br>"; // Texto da mensagem
$mail->Body    .= " <strong>Assunto</strong>: ".$_POST['assunto']."<br>"; // Texto da mensagem
$mail->Body    .= " <strong>Mensagem:</strong> ".nl2br($_POST['mensagem'])."<br><br><hr>"; // Texto da mensagem
 
// ENVIO DO EMAIL
$enviado = $mail->Send();
// Limpa os destinatários e os anexos
$mail->ClearAllRecipients();
 
// Exibe uma mensagem de resultado do envio (sucesso/erro)
if ($enviado) {
  echo "<script>alert('E-mail enviado com sucesso!');</script>";
  echo "<script>self.location='index.php' </script> ";
} else {
  echo "<script>alert('Sinto, muito. Não foi possível enviar o e-mail! :(');</script>";
  echo "<script>self.location='index.php' </script> ";
  echo "<b>Detalhes do erro:</b> " . $mail->ErrorInfo;
}
