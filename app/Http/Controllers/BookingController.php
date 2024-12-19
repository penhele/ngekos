<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerInformationStoreRequest;
use App\Interfaces\BoardingHouseRepositoryInterface;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

class BookingController extends Controller
{
    private BoardingHouseRepositoryInterface $boardingHouseRepository;
    private TransactionRepository $transactionRepository;

    public function __construct(
        BoardingHouseRepositoryInterface $boardingHouseRepository,
        TransactionRepository $transactionRepository
    ) {
        $this->boardingHouseRepository = $boardingHouseRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function booking(Request $request, $slug) 
    {
        $this->transactionRepository->saveTransactionToSession($request->all());
        return redirect()->route('booking.information', $slug);
    }

    public function information($slug) {
        $transtion = $this->transactionRepository->getTransactionDataFromSession();
        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseBySlug($slug);
        $room = $this->boardingHouseRepository->getBoardingHouseRoomBySlug($transtion['room_id']);

        return view('pages.booking.information', compact('transtion', 'boardingHouse', 'room'));
    }

    public function saveInformation(CustomerInformationStoreRequest $request, $slug)
    {
        $data = $request->validated();
        $this->transactionRepository->saveTransactionToSession($data);

        dd($this->transactionRepository->getTransactionDataFromSession());
    }

    public function check()
    {
        return view('pages.check-booking');
    }
}
