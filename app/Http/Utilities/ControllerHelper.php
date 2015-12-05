namespace App\Http\Utilities;

class ControllerHelper {

	public function redirect($query){
        
        if(empty($query)){

            return redirect('chart_update') -> with('error','Could not find NHI'); 
        }

}
}