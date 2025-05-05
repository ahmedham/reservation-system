<?php

namespace App\Http\Requests;

use App\Models\Reservation;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'reservation_date' => ['required','date','after:now'],
        ];
    }

    public function withValidator(Validator $validator)
{
    $validator->after(function ($validator) {
        $userId = auth()->id(); // or $this->user()->id if applicable
        $reservationDate = $this->input('reservation_date');

        $exists = Reservation::where('user_id', $userId)
            ->where('reservation_date', $reservationDate)
            ->exists();

        if ($exists) {
            $validator->errors()->add('reservation_date', 'You already have a reservation at this date and time.');
        }
    });
}

}
