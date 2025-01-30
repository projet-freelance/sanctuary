<?php
namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminConsultationController extends Controller
{
    public function __construct()
    {
        $this->middleware('aimeos.admin'); // Restriction aux administrateurs Aimeos
    }

    public function index()
    {
        $consultations = Consultation::where('status', 'scheduled')
            ->orderBy('scheduled_at')
            ->paginate(10);

        return view('admin.consultations.index', compact('consultations'));
    }

    public function complete($id)
    {
        $consultation = Consultation::findOrFail($id);
        $consultation->update(['status' => 'completed']);

        return back()->with('success', 'Consultation marquée comme terminée.');
    }
}
