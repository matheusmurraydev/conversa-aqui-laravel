<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EventoLocais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_evento', ['unico', 'recorrente']);
            $table->date('data_evento');
            $table->enum('tipo_local', ['presencial', 'online']);
            $table->enum('genero', ['homens', 'mulheres', 'outros']);
            $table->enum('pessoas_interessadas', ['sim', 'nao']);
            $table->integer('faixa_etaria');
            $table->enum('pessoas_especificas', ['sim', 'nao']);
            $table->string('foto_evento')->nullable();
            $table->text('descricao')->nullable();
            $table->integer('duracao')->nullable();
            $table->enum('vagas', ['Eu vou escolher', 'Todos'])->nullable();
            // Adicione outros campos necessários para o modelo Evento
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventos');
    }
}
