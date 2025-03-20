<?php

namespace App\Http\Controllers;

use App\Models\{Specialist, Specialty};
use Illuminate\Http\Request;
use Carbon\Carbon;

class SpecialistController extends Controller
{
    /**
     * عرض قائمة المختصين.
     */
    public function index()
    {
        $specialists = Specialist::with(['reviews', 'specialties'])
            ->withCount('sessions')
            ->get();

        return view('specialists.index', compact('specialists'));
    }
    public function indexSpecialist(Specialty $specialty)
    {

        $specialists=$specialty->specialists()->with("user")->get();
        return view('specialists.index', compact('specialists'));
    }


    /**
     * عرض صفحة المختص.
     */
    public function show(Specialist $specialist)
    {
        $specialist->load(['reviews', 'specialties']);

        // Generate available time slots for the next 7 days
        $availableSlots = collect();
        for ($i = 0; $i < 7; $i++) {
            $date = now()->addDays($i);
            // Add slots from 9 AM to 5 PM
            for ($hour = 9; $hour <= 17; $hour++) {
                $availableSlots->push(
                    Carbon::parse($date)->setHour($hour)->setMinute(0)
                );
            }
        }

        return view('specialists.show', [
            'specialist' => $specialist,
            'availableSlots' => $availableSlots
        ]);
    }

    /**
     * عرض صفحة حجز موعد مع المختص.
     */
    public function book(Specialist $specialist)
    {
        return view('specialists.book', compact('specialist'));
    }

    /**
     * حفظ حجز موعد جديد.
     */
    public function storeBooking(Request $request, Specialist $specialist)
    {
        $validated = $request->validate([
            'date' => 'required|date|after:today',
            'time' => 'required',
            'type' => 'required|in:online,in-person',
            'notes' => 'nullable|string|max:500'
        ]);

        $booking = $specialist->bookings()->create([
            'user_id' => auth()->id(),
            'date' => $validated['date'],
            'time' => $validated['time'],
            'type' => $validated['type'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending'
        ]);

        return redirect()->route('specialists.show', $specialist)
            ->with('success', 'تم إرسال طلب الحجز بنجاح. سيتم التواصل معك قريباً لتأكيد الموعد.');
    }

    /**
     * إضافة تقييم جديد للمختص.
     */
    public function storeReview(Request $request, Specialist $specialist)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'content' => 'required|string|max:500'
        ]);

        $specialist->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'content' => $validated['content']
        ]);

        return response()->json(['success' => true,
        'review' => $specialist->reviews()->latest()->first()
            ->load('user')
    ]);
        // return redirect()->route('specialists.show', $specialist)
        //     ->with('success', 'شكراً لك! تم إضافة تقييمك بنجاح.');
    }

}