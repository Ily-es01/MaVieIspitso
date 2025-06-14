<?php

namespace App\Http\Controllers\Enseignant;

use App\Http\Controllers\Controller;
use App\Models\Seance;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmploiProfController extends Controller
{
   public function index(){
        $idEnseignant = Auth::id();

        // Define time slots for display
        $timeSlots = [
            '08:30:00', '09:30:00', '10:30:00', '11:30:00',
            '12:30:00', '13:30:00', '14:30:00', '15:30:00',
            '16:30:00', '17:30:00'
        ];

        $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];

        // Get all sessions for this teacher directly from the seance table
        $allSeances = Seance::with('module', 'salle', 'user')
            ->where('ID_utilisateur', $idEnseignant)
            ->get();

        // Organize sessions by day and determine their span across time slots
        $seancesByDay = [];
        $seanceSpans = [];

        foreach ($jours as $jour) {
            $seancesByDay[$jour] = [];
        }

        foreach ($allSeances as $seance) {
            $jour = $seance->jour;

            // Calculate how many time slots this session spans
            $startTime = Carbon::createFromFormat('H:i:s', $seance->HeureDebut_seance);
            $endTime = Carbon::createFromFormat('H:i:s', $seance->HeureFin_seance);

            // Find the start and end slots indices
            $startSlotIndex = null;
            $endSlotIndex = null;

            for ($i = 0; $i < count($timeSlots); $i++) {
                $slotTime = Carbon::createFromFormat('H:i:s', $timeSlots[$i]);

                // Find the starting slot (the session starts at or before this slot)
                if ($startSlotIndex === null && $startTime->lte($slotTime)) {
                    $startSlotIndex = $i;
                }

                // Find the ending slot (the session ends after this slot but before the next slot)
                if ($endSlotIndex === null && $endTime->lt($slotTime)) {
                    $endSlotIndex = $i - 1;
                    break;
                }
            }

            // If we haven't found an end slot, it means the session ends after the last time slot
            if ($endSlotIndex === null) {
                $endSlotIndex = count($timeSlots) - 1;
            }

            // Store the span information
            $seanceSpans[$seance->ID_seance] = [
                'startSlot' => $startSlotIndex,
                'endSlot' => $endSlotIndex,
                'rowspan' => max(1, $endSlotIndex - $startSlotIndex + 1)
            ];

            // Add the session to the appropriate day
            $seancesByDay[$jour][] = $seance;
        }

        return view('enseignant.emploi-ens', compact('timeSlots', 'jours', 'seancesByDay', 'seanceSpans'));


   }


}
