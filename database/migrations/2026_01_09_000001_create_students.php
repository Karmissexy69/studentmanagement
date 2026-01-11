
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up(){
Schema::create('students',function(Blueprint $t){
$t->id();
$t->string('name');
$t->string('email')->unique();
$t->timestamps();
});
}
public function down(){ Schema::dropIfExists('students'); }
};
