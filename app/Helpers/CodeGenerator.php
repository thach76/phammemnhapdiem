<?php

namespace App\Helpers;

class CodeGenerator
{
    // Sinh mã lớp: L25TVTD
    public static function classCode($year, $major)
    {
        return 'L' . $year . strtoupper($major);
    }

    // Sinh mã môn: A101
    public static function subjectCode($khoa, $to, $stt)
    {
        return strtoupper($khoa) . $to . str_pad($stt, 2, '0', STR_PAD_LEFT);
    }

    // Sinh mã học viên: H25TVTD001
    public static function studentCode($year, $major, $stt)
    {
        return 'H' . $year . strtoupper($major) . str_pad($stt, 3, '0', STR_PAD_LEFT);
    }

    // Sinh mã giảng viên: GVA101
    public static function teacherCode($khoa, $to, $stt)
    {
        return 'GV' . strtoupper($khoa) . $to . str_pad($stt, 2, '0', STR_PAD_LEFT);
    }

    // Sinh mã đại đội trưởng: DD0101
    public static function daiDoiCode($dd, $td)
    {
        return 'DD' . str_pad($dd, 2, '0', STR_PAD_LEFT) . str_pad($td, 2, '0', STR_PAD_LEFT);
    }

    // Sinh mã tiểu đoàn trưởng: TD0001
    public static function tieuDoanCode($stt)
    {
        return 'TD' . str_pad($stt, 4, '0', STR_PAD_LEFT);
    }

    // Sinh mã phòng đào tạo: PDT001
    public static function phongDaoTaoCode($stt)
    {
        return 'PDT' . str_pad($stt, 3, '0', STR_PAD_LEFT);
    }

    // Sinh mã admin: ADMBKH (cố định hoặc config)
    public static function adminCode($boPhan)
    {
        return 'ADM' . strtoupper($boPhan);
    }
}
