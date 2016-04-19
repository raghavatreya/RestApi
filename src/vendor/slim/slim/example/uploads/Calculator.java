
package calculator;

import java.awt.Color;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.WindowEvent;
import java.awt.event.WindowFocusListener;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashMap;
import java.util.Map;
import java.util.Stack;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.JTextField;


public class Calculator implements ActionListener{
    
    private final JFrame main;
    private final JPanel displayPanel;
    private final JTextField display;
    private final JTextField last;
    private final JTextField mvalue;
    private final JButton mc,mr,mp,c,del,pm,div,pi,root,rooty,seven,eight,nine,mul,sin,cos,tan,four,five,six,sub,
            ln,log,powerten,one,two,three,add,fact,square,power,zero,perc,point,equal;
    private final String[] names = {"MC","MR","M+","C","Del","±","÷","π","√","<html><font size='4'><sup>y</sup></font>√</html>",
            "7","8","9","x","sin","cos","tan","4","5","6","-","ln","log","<html>10<sup>x</sup></html>","1","2","3","+",
            "n!","<html>x<sup>2</sup></html>","<html>x<sup>y</sup></html>","%","0",".","="};
    
     Calculator() {
        main = new JFrame("Calculator");
        main.setSize(640, 480);
        main.setLayout(null);
        main.getContentPane().setBackground(Color.BLACK);
        
        last = new JTextField();
        last.setBounds(400, 10, 180, 30);
        last.setHorizontalAlignment(JTextField.RIGHT);
        last.setBorder(null);
        last.setText("√5842");
        last.setEditable(false);
        last.setForeground(Color.WHITE);
        last.setBackground(Color.BLACK);
        last.setFont(last.getFont().deriveFont(22f));
        
        mvalue = new JTextField();
        mvalue.setBounds(40, 10, 30, 30);
        mvalue.setHorizontalAlignment(JTextField.RIGHT);
        mvalue.setBorder(null);
        mvalue.setText("M");
        mvalue.setEditable(false);
        mvalue.setFont(mvalue.getFont().deriveFont(22f));
        mvalue.setForeground(Color.WHITE);
        mvalue.setBackground(Color.BLACK);
        
        display = new JTextField();
        display.setBounds(40, 40, 540, 60);
        display.setHorizontalAlignment(JTextField.RIGHT);
        display.setBorder(null);
        display.setForeground(Color.WHITE);
        display.setBackground(Color.BLACK);
        display.setFont(display.getFont().deriveFont(50f));
        
        displayPanel = new JPanel();
        displayPanel.setBackground(Color.BLACK);
        displayPanel.setLayout(new GridLayout(5,7,10,10));
        displayPanel.setBounds(40, 120, 540, 250);
        
        mc = new JButton();
        mr = new JButton();
        mp = new JButton();
        c = new JButton();
        del = new JButton();
        pm = new JButton();
        div = new JButton();
        pi = new JButton();
        root = new JButton();
        rooty = new JButton();
        seven = new JButton();
        eight = new JButton();
        nine = new JButton();
        mul = new JButton();
        sin = new JButton();
        cos = new JButton();
        tan = new JButton();
        four = new JButton();
        five = new JButton();
        six = new JButton();
        sub = new JButton();
        ln = new JButton();
        log = new JButton();
        powerten = new JButton();
        one = new JButton();
        two = new JButton();
        three = new JButton();
        add = new JButton();
        fact = new JButton();
        square = new JButton();
        power = new JButton();
        zero = new JButton();
        perc = new JButton();
        point = new JButton();
        equal = new JButton();
        
        JButton[] buttons = {mc,mr,mp,c,del,pm,div,pi,root,rooty,seven,eight,nine,mul,sin,cos,tan,
            four,five,six,sub,ln,log,powerten,one,two,three,add,fact,square,power,perc,zero,point,equal};
        
        Integer[] blacks = {10, 11, 12, 17, 18, 19, 24, 25, 26, 31, 32, 33};
        
        int i=0;
        for(JButton button : buttons){
            button.setText(names[i]);
            button.setFont(button.getFont().deriveFont(18f));
            button.setForeground(Color.WHITE);
            if(Arrays.asList(blacks).contains(i)){
                button.setBackground(new Color(64, 64, 64));
            }
            else if(i == 34){
                button.setBackground(new Color(71, 135, 255));
            }
            else{
                button.setBackground(new Color(92, 92, 92));
            }
            //button.addActionListener(new ButtonActionListner());
            displayPanel.add(button);
            i++;
        }
        
        main.add(mvalue);
        main.add(last);
        main.add(display);
        main.add(displayPanel);
        main.setVisible(true);
        display.requestFocus();
        main.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
    }
 
        public void actionPerformed(ActionEvent e) {
            if(e.getSource() == one){
                display.setText(display.getText()+"1");
            }
            if(e.getSource() == two){
                display.setText(display.getText()+"2");
            }
            if(e.getSource() == three){
                display.setText(display.getText()+"3");
            }
            if(e.getSource() == four){
                display.setText(display.getText()+"4");
            }
            if(e.getSource() == five){
                display.setText(display.getText()+"5");
            }
            if(e.getSource() == six){
                display.setText(display.getText()+"6");
            }
            if(e.getSource() == seven){
                display.setText(display.getText()+"7");
            }
            if(e.getSource() == eight){
                display.setText(display.getText()+"8");
            }
            if(e.getSource() == nine){
                display.setText(display.getText()+"9");
            }
            if(e.getSource() == zero){
                display.setText(display.getText()+"0");
            }
            if(e.getSource() == add){
                display.setText(display.getText()+"+");
            }
            if(e.getSource() == sub){
                display.setText(display.getText()+"-");
            }
            if(e.getSource() == mul){
                display.setText(display.getText()+"*");
            }
            if(e.getSource() == div){
                display.setText(display.getText()+"÷");
            }
            if(e.getSource() == c){
                display.setText("");
            }
            if(e.getSource() == equal){
                String query = display.getText();
               // String[] rpn = toRPN(preprocess(query));
               // Call Eval function on click
            }
        }
        
    
	 public static void main(String[] args) {
        new Calculator();
    
	 }
}

