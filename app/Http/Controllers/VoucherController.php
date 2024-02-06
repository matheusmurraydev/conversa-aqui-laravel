<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use BaconQrCode\Encoder\QrCode;

class VoucherController extends Controller
{
    public function criarVoucher(Request $request)
    {
        // Lógica para validar e salvar os dados do voucher no banco de dados

        // Exemplo: obtendo os dados do formulário
        $dadosVoucher = $request->all();

        // Lógica para upload de imagem (se necessário)
        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $caminhoImagem = $this->salvarImagem($imagem);
            $dadosVoucher['imagem'] = $caminhoImagem;
        }

        // Lógica para gerar QR Code (se necessário)
        if ($dadosVoucher['gerar_qr_code']) {
            $dadosVoucher['qr_code'] = $this->gerarQRCode($dadosVoucher);
        }

        // Lógica para salvar os dados do voucher no banco de dados
        // Exemplo: Voucher::create($dadosVoucher);

        return response()->json($dadosVoucher, 201);
    }

    private function salvarImagem($imagem)
    {
        $caminho = 'caminho/para/salvar/as/imagens';
        $nomeImagem = time() . '.' . $imagem->getClientOriginalExtension();

        $imagem = Image::make($imagem)->resize(300, 200)->save($caminho . '/' . $nomeImagem);

        return $caminho . '/' . $nomeImagem;
    }

    private function gerarQRCode($dadosVoucher)
    {
        $qrCode = QrCode::encode(json_encode($dadosVoucher));

        // Salvar ou exibir o QR Code conforme necessário
        // Exemplo: $qrCode->writeFile('caminho/para/salvar/qrcode.png');

        return $qrCode->getString();
    }
}
