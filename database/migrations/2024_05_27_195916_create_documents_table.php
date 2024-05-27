<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('document_type'); // Tipo de documento (factura, boleta, etc.)
            $table->date('date'); // Fecha de emisión del documento
            $table->string('number'); // Número de la factura
            $table->string('serie'); // Serie del documento
            $table->unsignedBigInteger('customer_id'); // ID del cliente
            $table->unsignedBigInteger('company_id'); // ID de la compañía que emite la factura
            $table->string('status'); // Estado del documento (Aceptado, Rechazado, Pendiente, etc.)
            $table->text('error')->nullable(); // Mensaje de error si la factura fue rechazada
            $table->string('hash'); // Hash de la factura generada
            $table->text('xml'); // XML de la factura enviada
            $table->text('cdr')->nullable(); // CDR de la respuesta de SUNAT (Codificado en base64)
            $table->timestamps();

            // Definición de claves foráneas
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
