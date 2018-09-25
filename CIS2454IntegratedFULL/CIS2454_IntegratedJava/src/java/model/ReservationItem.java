/*
 * Timothy Ian Anderson
 * CIS 2454
 * Integrated Project
 */
package model;

import java.io.Serializable;

public class ReservationItem implements Serializable {
    private String itemCode;
    private String type;
    private String description;
    private int travelers;
    private String startDate;
    private String endDate;

    public ReservationItem(String itemCode, String type, String description, 
            int travelers, String startDate, String endDate) {
        this.itemCode = itemCode;
        this.type = type;
        this.description = description;
        this.travelers = travelers;
        this.startDate = startDate;
        this.endDate = endDate;
    }

    public String getItemCode() {
        return itemCode;
    }

    public void setItemCode(String itemCode) {
        this.itemCode = itemCode;
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }
    
    public int getTravelers() {
        return travelers;
    }

    public void setTravelers(int travelers) {
        this.travelers = travelers;
    }

    public String getStartDate() {
        return startDate;
    }

    public void setStartDate(String startDate) {
        this.startDate = startDate;
    }

    public String getEndDate() {
        return endDate;
    }

    public void setEndDate(String endDate) {
        this.endDate = endDate;
    }
     
}
