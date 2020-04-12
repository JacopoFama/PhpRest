<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('./class/Student.php');
include('./class/Class.php');
$student = new Student();
$class = new ClassCon();

switch($requestMethod)
{
	case 'GET':
		$id = '';
		if(isset($_GET['id'])) {
			$id = $_GET['id'];
			$student->_id = $id;
			$data = $student->one();
		} else {
			$data = $student->list();
		}
		if(!empty($data)) {
          $js_encode = json_encode($data, true);
        } else {
          $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet.'), true);
        }
        header('Content-Type: application/json');
		echo $js_encode;
        break;
        
        case 'GETClass':
            $id = '';
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $class->_id = $id;
                $data = $class->one();
            } else {
                $data = $class->list();
            }
            if(!empty($data)) {
              $js_encode = json_encode($data, true);
            } else {
              $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet.'), true);
            }
            header('Content-Type: application/json');
            echo $js_encode;
            break;
    
    case 'POST':
        $stud = json_decode(file_get_contents("php://input"),true);

        if(strcmp($stud['name'],"") != 0 && strcmp($stud['surname'],"") != 0 && strcmp($stud['sidi_code'],"") != 0 && strcmp($stud['tax_code'],"") != 0)
        {
            $student->_name = $stud['name'];
            $student->_surname = $stud['surname'];
            $student->_sidiCode = $stud['sidi_code'];
            $student->_taxCode = $stud['tax_code'];

            $data = $student->insert();
            if(!empty($data))
            {
                $js_encode = json_encode(array('status'=>TRUE, 'studentInfo'=>$data), true);
            }
            else
            {
                $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet.'), true);
            }

            $data = $student->getLast();
            if(!empty($data))
            {
                $js_encode = json_encode(array('status'=>TRUE, 'studentInfo'=>$data), true);
            }
            else
            {
                $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet.'), true);
            }
            header('Content-Type: application/json');
            echo "<b>Aggiunto: </b>" . $js_encode;
        }
        else
        {
            echo "POST studente non valido";
        }
        break;

        case 'POSTClass':
            $cla = json_decode(file_get_contents("php://input"),true);
    
            if(strcmp($cla['year'],"") != 0 && strcmp($cla['section'],"") != 0)
            {
                $class->_year = $cla['year'];
                $class->_section = $cla['section'];
    
                $data = $class->insert();
                if(!empty($data))
                {
                    $js_encode = json_encode(array('status'=>TRUE, 'classInfo'=>$data), true);
                }
                else
                {
                    $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet.'), true);
                }
    
                $data = $class->getLast();
                if(!empty($data))
                {
                    $js_encode = json_encode(array('status'=>TRUE, 'classInfo'=>$data), true);
                }
                else
                {
                    $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet.'), true);
                }
                header('Content-Type: application/json');
                echo "<b>Aggiunto: </b>" . $js_encode;
            }
            else
            {
                echo "POST classe non valido";
            }
            break;

    case 'DELETE':
        $id = $_GET['id'];
        $student->_id = $id;
        $data = $student->delete();
        if(!empty($data))
        {
            $js_encode = json_encode(array('status'=>TRUE, 'studentInfo'=>$data), true);
        }
        else
        {
            $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet.'), true);
        }
        header('Content-Type: application/json');
        echo $js_encode;
        break;

    case 'DELETEClass':
        $id = $_GET['id'];
        $class->_id = $id;
        $data = $class->delete();
        if(!empty($data))
        {
            $js_encode = json_encode(array('status'=>TRUE, 'classInfo'=>$data), true);
        }
        else
        {
            $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet.'), true);
        }
        header('Content-Type: application/json');
        echo $js_encode;
        break;

    case 'PATCH':
        $stud = json_decode(file_get_contents("php://input"),true);

        if(strcmp($stud['id'], "")!=0)
        {
            $student->_id = $stud['id'];
            foreach($stud as $key => $value)
            {
                if(strcmp($value,"")!=0)
                {
                    $student->{"_$key"} = $value;
                }
            }

            $data = $student->patch();
            if(!empty($data))
            {
                $js_encode = json_encode(array('status'=>TRUE, 'studentInfo'=>$data), true);
            }
            else
            {
                $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet or data is the same as previous.'), true);
            }

            $data = $student->one();
            if(!empty($data))
            {
                $js_encode = json_encode(array('status'=>TRUE, 'studentInfo'=>$data), true);
            }
            else
            {
                $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet or data is the same as previous.'), true);
            }
            header('Content-Type: application/json');
            echo "<b>Modificato: </b>" . $js_encode;
        }
        else
        {
            echo "PATCH studente non valido";
        }
        break;

    case 'PATCHClass':
        $cla = json_decode(file_get_contents("php://input"),true);

        if(strcmp($cla['id'], "")!=0)
        {
            $class->_id = $cla['id'];
            foreach($cla as $key => $value)
            {
                if(strcmp($value,"")!=0)
                {
                    $class->{"_$key"} = $value;
                }
            }

            $data = $class->patch();
            if(!empty($data))
            {
                $js_encode = json_encode(array('status'=>TRUE, 'classInfo'=>$data), true);
            }
            else
            {
                $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet or data is the same as previous.'), true);
            }

            $data = $class->one();
            if(!empty($data))
            {
                $js_encode = json_encode(array('status'=>TRUE, 'classInfo'=>$data), true);
            }
            else
            {
                $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet or data is the same as previous.'), true);
            }
            header('Content-Type: application/json');
            echo "<b>Modificato: </b>" . $js_encode;
        }
        else
        {
            echo "PATCH classe non valido";
        }
        break;

    case 'PUT':
        $stud = json_decode(file_get_contents("php://input"),true);

        if(strcmp($stud['id'],"") != 0 && strcmp($stud['name'],"") != 0 && strcmp($stud['surname'],"") != 0 && strcmp($stud['sidi_code'],"") != 0 && strcmp($stud['tax_code'],"") != 0)
        {
            $student->_id = $stud['id'];
            $student->_name = $stud['name'];
            $student->_surname = $stud['surname'];
            $student->_sidiCode = $stud['sidi_code'];
            $student->_taxCode = $stud['tax_code'];

            $data = $student->put();
            if(!empty($data))
            {
                $js_encode = json_encode(array('status'=>TRUE, 'studentInfo'=>$data), true);
            }
            else
            {
                $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet or data is the same as previous.'), true);
            }

            $data = $student->one();
            if(!empty($data))
            {
                $js_encode = json_encode(array('status'=>TRUE, 'studentInfo'=>$data), true);
            }
            else
            {
                $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet or data is the same as previous.'), true);
            }
            header('Content-Type: application/json');
            echo "<b>Modificato: </b>" . $js_encode;
        }
        else
        {
            echo "PUT studente non valido";
        }
        break;

        case 'PUTClass':
            $cla = json_decode(file_get_contents("php://input"),true);
    
            if(strcmp($cla['id'],"") != 0 && strcmp($cla['year'],"") != 0 && strcmp($cla['section'],"") != 0)
            {
                $class->_id = $cla['id'];
                $class->_name = $cla['year'];
                $class->_section = $cla['section'];
    
                $data = $class->put();
                if(!empty($data))
                {
                    $js_encode = json_encode(array('status'=>TRUE, 'classInfo'=>$data), true);
                }
                else
                {
                    $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet or data is the same as previous.'), true);
                }
    
                $data = $class->one();
                if(!empty($data))
                {
                    $js_encode = json_encode(array('status'=>TRUE, 'classInfo'=>$data), true);
                }
                else
                {
                    $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet or data is the same as previous.'), true);
                }
                header('Content-Type: application/json');
                echo "<b>Modificato: </b>" . $js_encode;
            }
            else
            {
                echo "PUT classe non valido";
            }
            break;

    default:
	    header("HTTP/1.0 405 Method Not Allowed");
	    break;
}
?>