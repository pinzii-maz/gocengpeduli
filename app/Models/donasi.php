<?php

namespace App\Models;

use PhpParser\Node\Expr\Cast;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class donasi extends Model
{
    protected $appends = ['total_terkumpul', 'persentase', 'jumlah_donatur', 'sisa_hari', 'deadline_label'];
    protected $table = 'donations';
    protected $casts = [
        'deadline' => 'datetime'
    ];
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'target_amount',
        'deadline',
        'image',
        'recipient_count',
        'current_amount',
        'donor_count',
        'report_document'
    ];

    

    public function transaksis() {
        return $this->hasMany(Transaksi::class,'donation_id');
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function getTotalTerkumpulAttribute()
    {
        return $this->transaksis
            ->where('status', 'success')
            ->sum('amount');
    }

    public function successfulTransactions()
{
    // Method relasi HANYA mendefinisikan hubungan.
    // Ini akan mengembalikan object relasi, bukan nilai.
    return $this->hasMany(Transaksi::class, 'donation_id')
                ->where('status', 'success')
                ->latest(); // Mengurutkan dari donatur terbaru
}

    public function getPersentaseAttribute()
    {
        if ($this->target_amount <= 0) {
            return 0;
        }
        $percentage = ($this->total_terkumpul / $this->target_amount) * 100;
        return min(round($percentage), 100);
    }

    public function getJumlahDonaturAttribute()
    {
        if ($this->relationLoaded('successfulTransactions')) {
            
            return $this->successfulTransactions->count();
        }
        
        return $this->transaksis()->where('status', 'success')->count();
    }

    public function getSisaHariAttribute()
    {
    if (!$this->deadline) { // ✅ Akses via properti Carbon
        return "Deadline tidak ditentukan";
    }

    $deadline = \Carbon\Carbon::parse($this->attributes['deadline'])->startOfDay();
    $now = now()->startOfDay();
    $hariTersisa = $now->diffInDays($deadline, false);

    if ($hariTersisa > 0) {
        return "$hariTersisa hari lagi";   
    } elseif ($hariTersisa === 0) {
        return "hari ini";       
    } else {
        return "tenggat telah lewat";
    }
}

    
    public function getDeadlineBgColorAttribute()
    {
        if ($this->deadline_color === 'hijau') {
    return 'bg-green-500';
        } else {
        return 'bg-red-500';
    }
} 

    public function updateStats()
{
    $this->current_amount = $this->transaksis()
    ->where('status', 'success')
    ->sum('amount');

    $this->donor_count = $this->transaksis()
    ->where('status', 'success')
    ->distinct('donor_email')
    ->count('donor_email');

    $this->save();
}

    public function getDeadlineLabelAttribute()   
{
    if (!$this->deadline) {
        return "Belum ditentukan";
    }
    
    return match(true) {
        $this->sisa_hari === "tenggat telah lewat" => "Ditutup",
        $this->sisa_hari === "hari ini" => "Batas akhir hari ini",
        default => $this->sisa_hari
    };
}   

}