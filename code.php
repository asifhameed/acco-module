<?php
class Account {
    protected $file_name = "";
    
    public function __construct()
    { 
        $date_file = date("M-Y-His");
        $this->file_name = 'account_payroll_system_'.$date_file.'.csv';
    }

    public function files_function() {
        $next12months = $this->get_next_12_months();
        // echo "<pre>";
        // print_r($next12months); 
        
        
        $data = ['Month Name,Salary Payment Date,Bonus Payment Date'];
        foreach($next12months as $rows)
        {
            $data[] = $rows;
        }
        // echo "<pre>";
        // print_r($data);
        
        $generate_csv = $this->csv($data, $this->file_name);
        if($generate_csv)
        {
            echo "CSV file generate successfully. The file name is ".$generate_csv;
        }
        else
        {
            echo "Sorry script working.";
        }

    }
    private function get_next_12_months()
    {
        $months = array();
        $current_month = (int)date('m');
        for ($i = $current_month; $i < $current_month + 12; $i++) {
            /****************************************************************/
            /*                                                              */
            /*                  Salary Payment Date                         */
            /*                                                              */
            /****************************************************************/
            // Last date of month
            $lastDateOfMonth = date("Y-m-t", mktime(0, 0, 0, $i, 1));   
            
            // Last day of the month
            $lastGetDate = strtotime(date("Y-m-t", strtotime($lastDateOfMonth)));
            $lastDayOfMonth = date("l", $lastGetDate);

            // Check the Weekend
            if($lastDayOfMonth === 'Sunday')
            {
                $lastDateOfMonth = date('Y-m-d',(strtotime('-2 day' , strtotime($lastDateOfMonth))));
            }
            else if($lastDayOfMonth === 'Saturday')
            {
                $lastDateOfMonth = date('Y-m-d',(strtotime('-1 day' , strtotime($lastDateOfMonth))));
            }
            $salaryPaymentDate = date('d/m/Y', strtotime($lastDateOfMonth));
            
            /****************************************************************/
            /*                                                              */
            /*             Bonus Payment Date calculate                     */
            /*                                                              */
            /****************************************************************/
            
            // 15 date of month
            $midDateOfMonth = date('Y-m-15', strtotime($lastDateOfMonth));

            // Next Month date
            $midDateOfMonth = date("Y-m-d", strtotime ('+1 month', strtotime($midDateOfMonth)));
            
            // 15 day of the month
            $bonousDayOfMonth = date("l", strtotime($midDateOfMonth));

            // Check the Weekend
            if($bonousDayOfMonth === 'Sunday')
            {
                $midDateOfMonth = date('Y-m-d',(strtotime('+3 day' , strtotime($midDateOfMonth))));
            }
            else if($bonousDayOfMonth === 'Saturday')
            {
                $midDateOfMonth = date('Y-m-d',(strtotime('+4 day' , strtotime($midDateOfMonth))));
            }
            // $bonousDayOfMonth = date("l", strtotime($midDateOfMonth));
            $bonusPaymentDate = date('d/m/Y', strtotime($midDateOfMonth));
            
            $months[] = date('F', mktime(0, 0, 0, $i, 1)). "," .$salaryPaymentDate. ",".$bonusPaymentDate;
        }
        return $months;
    }

    // Export to CSV
    private function csv($data, $file_name)
    {
        try{
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="'.$file_name.'"');
            // $fp = fopen('php://output', 'wb');
            $fp = fopen('downloads/'.$file_name, 'w');
            foreach ($data as $lines) {
                $value = explode(",", $lines);
                fputcsv($fp, $value);
            }
            fclose($fp);
            return $file_name;
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
        
    }
}

// $account = new Account();
// $account->files_function();
?>