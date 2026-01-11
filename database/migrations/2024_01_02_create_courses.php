
<?php
return new class extends \Illuminate\Database\Migrations\Migration {
public function up(){
\Schema::create('courses',function($t){
$t->id();
$t->string('name')->unique();
$t->timestamps();
});
}
public function down(){ \Schema::dropIfExists('courses'); }
};
